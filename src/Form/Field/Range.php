<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Field;

use Oneup\ContaoFormBundle\Attribute\AsField;
use Oneup\ContaoFormBundle\Form\AbstractField;
use Oneup\ContaoFormBundle\Form\FieldInterface;
use Symfony\Component\Form\Extension\Core\Type\RangeType;

#[AsField(name: 'range', formType: RangeType::class)]
class Range extends AbstractField implements FieldInterface
{
}
