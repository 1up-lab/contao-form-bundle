<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Field;

use Oneup\ContaoFormBundle\Attribute\AsField;
use Oneup\ContaoFormBundle\Form\AbstractField;
use Oneup\ContaoFormBundle\Form\FieldGroup;
use Oneup\ContaoFormBundle\Form\FieldInterface;
use Symfony\Component\Form\Extension\Core\Type\DateIntervalType;

#[AsField(name: 'dateInterval', formType: DateIntervalType::class, group: FieldGroup::Dates)]
class DateInterval extends AbstractField implements FieldInterface
{
}
