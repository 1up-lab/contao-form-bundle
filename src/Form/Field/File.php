<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Field;

use Contao\Config;
use Contao\StringUtil;
use Oneup\ContaoFormBundle\Attribute\AsField;
use Oneup\ContaoFormBundle\Form\AbstractField;
use Oneup\ContaoFormBundle\Form\FieldInterface;
use Oneup\ContaoFormBundle\Model\FieldModel;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\File as FileConstraint;

#[AsField(name: 'file', formType: FileType::class)]
class File extends AbstractField implements FieldInterface
{
    public function resolveOptions(FieldModel $model): array
    {
        $options = parent::resolveOptions($model);

        $options['multiple'] = $model->multipleFiles;

        return $options;
    }

    public function resolveConstraints(FieldModel $model, array $constraints): array
    {
        $constraints[] = new FileConstraint(
            maxSize: $this->getMaxFileSize(),
            extensions: array_fill_keys($this->getAllowedExtensions(), []),
        );

        if (!$model->multipleFiles) {
            return $constraints;
        }

        foreach ($constraints as $index => $constraint) {
            if ($constraint instanceof FileConstraint) {
                $constraints[$index] = new All([$constraint]);
            }
        }

        return $constraints;
    }

    private function getMaxFileSize(): ?int
    {
        $maxFileSize = Config::get('maxFileSize');

        if (\is_string($maxFileSize) && ctype_digit($maxFileSize)) {
            $maxFileSize = (int) $maxFileSize;
        }

        if (!\is_int($maxFileSize) || $maxFileSize < 1) {
            return null;
        }

        return $maxFileSize;
    }

    private function getAllowedExtensions(): array
    {
        $uploadTypes = Config::get('uploadTypes');

        return StringUtil::trimsplit(',', strtolower(\is_string($uploadTypes) ? $uploadTypes : ''));
    }
}
