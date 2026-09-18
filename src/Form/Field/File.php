<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Field;

use Oneup\ContaoFormBundle\Attribute\AsField;
use Oneup\ContaoFormBundle\Form\AbstractField;
use Oneup\ContaoFormBundle\Form\FieldInterface;
use Oneup\ContaoFormBundle\Model\FieldModel;

#[AsField(name: 'file', formType: FileType::class)]
class FileType extends AbstractField implements FieldInterface
{
    public function resolveOptions(FieldModel $model): array
    {
        return [
            'required' => $model->required,
            'label' => $model->label ?: $model->name,
            'label_html' => $model->labelHtml,
            'help' => $model->help,
            'help_html' => $model->helpHtml,
            'trim' => $model->trim,
            'attr' => [
                'placeholder' => $model->placeholder,
            ],
        ];
    }
}
