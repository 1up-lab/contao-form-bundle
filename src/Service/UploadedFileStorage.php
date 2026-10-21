<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Service;

use Contao\CoreBundle\Filesystem\Dbafs\UnableToResolveUuidException;
use Contao\CoreBundle\Filesystem\VirtualFilesystemInterface;
use Contao\FrontendUser;
use Contao\StringUtil;
use Oneup\ContaoFormBundle\File\StoredFile;
use Oneup\ContaoFormBundle\File\StoredFiles;
use Oneup\ContaoFormBundle\Model\FieldModel;
use Oneup\ContaoFormBundle\Model\FormModel;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Uid\Uuid;

class UploadedFileStorage
{
    public function __construct(
        #[Autowire(service: 'contao.filesystem.virtual.files')]
        private readonly VirtualFilesystemInterface $filesystem,
        private readonly Security $security,
        private readonly UrlGeneratorInterface $urlGenerator,
        #[Autowire(service: 'monolog.logger.contao.files')]
        private readonly LoggerInterface $filesLogger,
        #[Autowire(service: 'monolog.logger.contao.error')]
        private readonly LoggerInterface $errorLogger,
        #[Autowire(param: 'contao.upload_path')]
        private readonly string $uploadPath,
    ) {
    }

    public function store(FormModel $formModel, array $data): StoredFiles
    {
        $files = new StoredFiles();

        $this->traverseFields($files, $data, $formModel->id, 'tl_oneup_form');

        return $files;
    }

    private function traverseFields(StoredFiles $files, array $data, int $pid, string $ptable): void
    {
        $fields = FieldModel::findBy(['pid=?', 'ptable=?', 'published=?'], [$pid, $ptable, true]);

        if (null === $fields) {
            return;
        }

        foreach ($fields as $field) {
            $value = $data[$field->alias] ?? null;

            if ('file' === $field->type) {
                $this->storeFieldUploads($files, $field, $value);
            } elseif (\is_array($value)) {
                $this->traverseFields($files, $value, $field->id, 'tl_oneup_form_field');
            }
        }
    }

    private function storeFieldUploads(StoredFiles $files, FieldModel $model, mixed $value): void
    {
        if (!$model->storeFile && !$model->attachToEmail) {
            return;
        }

        $folder = $model->storeFile ? $this->getUploadFolder($model) : null;

        foreach (\is_array($value) ? $value : [$value] as $upload) {
            if ($upload instanceof UploadedFile) {
                $files->add($upload, $this->storeUpload($upload, $model, $folder));
            }
        }
    }

    private function storeUpload(UploadedFile $upload, FieldModel $model, ?string $folder): StoredFile
    {
        $path = null;
        $link = null;

        if (null !== $folder) {
            $path = $this->write($upload, $folder, $model->doNotOverwrite);
            $link = $model->addBackendLink ? $this->getBackendLink($folder) : null;
        }

        return new StoredFile(
            name: $upload->getClientOriginalName(),
            pathname: $upload->getPathname(),
            path: $path,
            link: $link,
            attachToEmail: $model->attachToEmail,
        );
    }

    private function getUploadFolder(FieldModel $model): ?string
    {
        $uuid = $model->uploadFolder;
        $user = $this->security->getUser();

        if ($model->useHomeDir && $user instanceof FrontendUser && $user->assignDir && $user->homeDir) {
            $uuid = $user->homeDir;
        }

        try {
            $folder = \is_string($uuid) ? $this->filesystem->resolveUuid(Uuid::fromBinary($uuid)) : null;
        } catch (\InvalidArgumentException|UnableToResolveUuidException) {
            $folder = null;
        }

        if (null === $folder || !$this->filesystem->directoryExists($folder)) {
            $this->errorLogger->warning(\sprintf('Could not store the uploaded files of field "%s" (ID %s), the upload folder is invalid', $model->name, $model->id));

            return null;
        }

        return $folder;
    }

    private function write(UploadedFile $upload, string $folder, bool $doNotOverwrite): string
    {
        $name = StringUtil::sanitizeFileName($upload->getClientOriginalName());

        if ($doNotOverwrite) {
            $name = $this->getUniqueName($folder, $name);
        }

        $location = $folder . '/' . $name;

        $this->filesystem->write($location, $upload->getContent());
        $this->filesLogger->info(\sprintf('File "%s/%s" has been uploaded', $this->uploadPath, $location));

        return $this->uploadPath . '/' . $location;
    }

    private function getBackendLink(string $folder): string
    {
        return $this->urlGenerator->generate('contao_backend', ['do' => 'files', 'fn' => $this->uploadPath . '/' . $folder], UrlGeneratorInterface::ABSOLUTE_URL);
    }

    private function getUniqueName(string $folder, string $name): string
    {
        $filename = pathinfo($name, \PATHINFO_FILENAME);
        $extension = pathinfo($name, \PATHINFO_EXTENSION);
        $suffix = '' !== $extension ? '.' . $extension : '';

        $candidate = $name;
        $offset = 1;

        while ($this->filesystem->fileExists($folder . '/' . $candidate)) {
            $candidate = $filename . '__' . ++$offset . $suffix;
        }

        return $candidate;
    }
}
