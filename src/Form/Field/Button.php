<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Field;

use Oneup\ContaoFormBundle\Attribute\AsField;
use Oneup\ContaoFormBundle\Form\AbstractField;
use Oneup\ContaoFormBundle\Form\FieldGroup;
use Oneup\ContaoFormBundle\Form\FieldInterface;
use Oneup\ContaoFormBundle\Model\FieldModel;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

#[AsField('submit', SubmitType::class, constrainable: false, group: FieldGroup::Buttons)]
#[AsField('button', ButtonType::class, constrainable: false, group: FieldGroup::Buttons)]
#[AsField('reset', ResetType::class, constrainable: false, group: FieldGroup::Buttons)]
class Button extends AbstractField implements FieldInterface
{
    public function resolveOptions(FieldModel $model): array
    {
        return [
            'label' => $model->label ?: $model->name,
        ];
    }
}
