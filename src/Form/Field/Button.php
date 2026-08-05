<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Field;

use Oneup\ContaoFormBundle\Attribute\AsField;
use Oneup\ContaoFormBundle\Form\AbstractField;
use Oneup\ContaoFormBundle\Form\FormFieldInterface;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

#[AsField('submit', SubmitType::class, constrainable: false)]
#[AsField('button', ButtonType::class, constrainable: false)]
#[AsField('reset', ResetType::class, constrainable: false)]
class Button extends AbstractField implements FormFieldInterface
{
    public function resolveOptions(array $row): array
    {
        return [
            'label' => $row['label'] ?: $row['name'],
        ];
    }
}
