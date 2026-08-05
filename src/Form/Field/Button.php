<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Field;

use Oneup\ContaoFormBundle\Attribute\AsFormField;
use Oneup\ContaoFormBundle\Form\AbstractField;
use Oneup\ContaoFormBundle\Form\FormFieldInterface;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

#[AsFormField('submit', SubmitType::class, constrainable: false)]
#[AsFormField('button', ButtonType::class, constrainable: false)]
#[AsFormField('reset', ResetType::class, constrainable: false)]
class Button extends AbstractField implements FormFieldInterface
{
    public function resolveOptions(array $row): array
    {
        return [
            'label' => $row['label'] ?: $row['name'],
        ];
    }
}
