<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Field;

use Oneup\ContaoFormBundle\Attribute\AsField;
use Oneup\ContaoFormBundle\Form\AbstractField;
use Oneup\ContaoFormBundle\Form\FieldInterface;
use Oneup\ContaoFormBundle\Model\FieldModel;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

#[AsField(name: 'hidden', formType: HiddenType::class, constrainable: false)]
class Hidden extends AbstractField implements FieldInterface
{
    public function resolveOptions(FieldModel $model): array
    {
        return [
            'label' => false,
        ];
    }

    public function resolveData(FieldModel $model): mixed
    {
        return $model->value ?: null;
    }
}
