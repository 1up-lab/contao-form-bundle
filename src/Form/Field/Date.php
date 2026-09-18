<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Field;

use Oneup\ContaoFormBundle\Attribute\AsField;
use Oneup\ContaoFormBundle\Form\AbstractField;
use Oneup\ContaoFormBundle\Form\FieldInterface;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateIntervalType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\WeekType;

#[AsField(name: 'birthday', formType: BirthdayType::class)]
#[AsField(name: 'dateInterval', formType: DateIntervalType::class)]
#[AsField(name: 'dateTime', formType: DateTimeType::class)]
#[AsField(name: 'date', formType: DateType::class)]
#[AsField(name: 'time', formType: TimeType::class)]
#[AsField(name: 'week', formType: WeekType::class)]
class Date extends AbstractField implements FieldInterface
{
}
