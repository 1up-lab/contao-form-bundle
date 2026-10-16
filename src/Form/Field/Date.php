<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Field;

use Oneup\ContaoFormBundle\Attribute\AsField;
use Oneup\ContaoFormBundle\Form\AbstractField;
use Oneup\ContaoFormBundle\Form\FieldGroup;
use Oneup\ContaoFormBundle\Form\FieldInterface;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateIntervalType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\WeekType;

#[AsField(name: 'birthday', formType: BirthdayType::class, group: FieldGroup::Dates)]
#[AsField(name: 'dateInterval', formType: DateIntervalType::class, group: FieldGroup::Dates)]
#[AsField(name: 'dateTime', formType: DateTimeType::class, group: FieldGroup::Dates)]
#[AsField(name: 'date', formType: DateType::class, group: FieldGroup::Dates)]
#[AsField(name: 'time', formType: TimeType::class, group: FieldGroup::Dates)]
#[AsField(name: 'week', formType: WeekType::class, group: FieldGroup::Dates)]
class Date extends AbstractField implements FieldInterface
{
}
