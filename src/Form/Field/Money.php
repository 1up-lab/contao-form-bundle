<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Field;

use Oneup\ContaoFormBundle\Attribute\AsField;
use Oneup\ContaoFormBundle\Form\AbstractField;
use Oneup\ContaoFormBundle\Form\FieldGroup;
use Oneup\ContaoFormBundle\Form\FieldInterface;
use Oneup\ContaoFormBundle\Model\FieldModel;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

#[AsField(name: 'money', formType: MoneyType::class, group: FieldGroup::Moneys)]
class Money extends AbstractField implements FieldInterface
{
    public function resolveOptions(FieldModel $model): array
    {
        $options = parent::resolveOptions($model);

        if ($model->placeholder) {
            $options['attr']['placeholder'] = $model->placeholder;
        }

        return $options;
    }
}
