<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Field;

use Oneup\ContaoFormBundle\Attribute\AsField;
use Oneup\ContaoFormBundle\Form\AbstractField;
use Oneup\ContaoFormBundle\Form\FieldGroup;
use Oneup\ContaoFormBundle\Form\FieldInterface;
use Oneup\ContaoFormBundle\Model\FieldModel;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;

#[AsField(name: 'integer', formType: IntegerType::class, group: FieldGroup::Numbers)]
#[AsField(name: 'number', formType: NumberType::class, group: FieldGroup::Numbers)]
#[AsField(name: 'percent', formType: PercentType::class, group: FieldGroup::Numbers)]
class Number extends AbstractField implements FieldInterface
{
    public function resolveOptions(FieldModel $model): array
    {
        $options = parent::resolveOptions($model);

        if ($model->placeholder) {
            $options['attr']['placeholder'] = $model->placeholder;
        }

        if (\in_array($model->type, ['number', 'percent'], true)) {
            $options['html5'] = $model->html5;
        }

        return $options;
    }
}
