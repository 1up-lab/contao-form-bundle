<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Flow;

use Oneup\ContaoFormBundle\File\TemporaryUpload;
use Symfony\Component\Form\Flow\DataStorage\DataStorageInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadedFileDataStorage implements DataStorageInterface
{
    public function __construct(
        private readonly DataStorageInterface $dataStorage,
        private readonly string $tempDir,
    ) {
    }

    public function save(object|array $data): void
    {
        if (\is_array($data)) {
            $data = $this->park($data);
        }

        $this->dataStorage->save($data);
    }

    public function load(object|array|null $default = null): object|array|null
    {
        $data = $this->dataStorage->load($default);

        if (\is_array($data)) {
            $data = $this->restore($data);
        }

        return $data;
    }

    public function clear(): void
    {
        $this->dataStorage->clear();
    }

    private function park(array $data): array
    {
        foreach ($data as $key => $value) {
            if ($value instanceof UploadedFile) {
                $data[$key] = $this->parkFile($value);
            } elseif (\is_array($value)) {
                $data[$key] = $this->park($value);
            }
        }

        return $data;
    }

    private function parkFile(UploadedFile $file): TemporaryUpload
    {
        $pathname = $file->getPathname();

        if (!str_starts_with($pathname, $this->tempDir . '/')) {
            $target = $this->tempDir . '/' . bin2hex(random_bytes(16));

            if (!copy($pathname, $target)) {
                throw new \RuntimeException(\sprintf('Could not copy the uploaded file "%s" to "%s".', $file->getClientOriginalName(), $target));
            }

            $pathname = $target;
        }

        return new TemporaryUpload($pathname, $file->getClientOriginalName(), $file->getClientMimeType());
    }

    private function restore(array $data): array
    {
        foreach ($data as $key => $value) {
            if ($value instanceof TemporaryUpload) {
                $data[$key] = $this->restoreFile($value);
            } elseif (\is_array($value)) {
                $data[$key] = $this->restore($value);
            }
        }

        return $data;
    }

    private function restoreFile(TemporaryUpload $upload): ?UploadedFile
    {
        if (!is_file($upload->pathname)) {
            return null;
        }

        return new UploadedFile($upload->pathname, $upload->name, $upload->mimeType, null, true);
    }
}
