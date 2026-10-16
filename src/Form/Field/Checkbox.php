<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Field;

use Oneup\ContaoFormBundle\Attribute\AsField;
use Oneup\ContaoFormBundle\Form\AbstractField;
use Oneup\ContaoFormBundle\Form\FieldGroup;
use Oneup\ContaoFormBundle\Form\FieldInterface;
use Oneup\ContaoFormBundle\Model\FieldModel;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;

#[AsField(name: 'checkbox', formType: CheckboxType::class, group: FieldGroup::Choices)]
#[AsField(name: 'radio', formType: RadioType::class, group: FieldGroup::Choices)]
class Checkbox extends AbstractField implements FieldInterface
{
    public function resolveOptions(FieldModel $model): array
    {
        return [
            ...parent::resolveOptions($model),
            'value' => $model->value ?: '1',
        ];
    }

    public function resolveData(FieldModel $model): mixed
    {
        return $model->checked ? true : null;
    }
}
