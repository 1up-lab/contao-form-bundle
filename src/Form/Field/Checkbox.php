<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Field;

use Oneup\ContaoFormBundle\Attribute\AsField;
use Oneup\ContaoFormBundle\Form\AbstractField;
use Oneup\ContaoFormBundle\Form\FieldInterface;
use Oneup\ContaoFormBundle\Model\FieldModel;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;

#[AsField(name: 'checkbox', formType: CheckboxType::class)]
#[AsField(name: 'radio', formType: RadioType::class)]
class Checkbox extends AbstractField implements FieldInterface
{
    public function resolveOptions(FieldModel $model): array
    {
        return [
            ...parent::resolveOptions($model),
            'value' => $model->value ?: '1',
        ];
    }
}
