<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Field;

use Oneup\ContaoFormBundle\Attribute\AsField;
use Oneup\ContaoFormBundle\Form\AbstractField;
use Oneup\ContaoFormBundle\Form\FormFieldInterface;
use Symfony\Component\Form\Extension\Core\Type\ColorType;

#[AsField('color', ColorType::class)]
class Color extends AbstractField implements FormFieldInterface
{
    public function resolveOptions(array $row): array
    {
        return [
            'html5' => (bool) $row['html5'],
        ];
    }
}
