<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\DateIntervalType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TimezoneType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\WeekType;

#[AsCallback(table: 'tl_oneup_form_field', target: 'fields.type.options')]
class FieldTypeOptionListener
{
    public function __invoke(): array
    {
        return [
            'text' => [
                EmailType::class,
                SearchType::class,
                TextType::class,
                TextareaType::class,
                TelType::class,
                UrlType::class,
            ],
            'buttons' => [
                ButtonType::class,
                ResetType::class,
                SubmitType::class,
            ],
            'choice' => [
                CheckboxType::class,
                ChoiceType::class,
                CountryType::class,
                LanguageType::class,
                RadioType::class,
            ],
            'date' => [
                BirthdayType::class,
                DateIntervalType::class,
                DateTimeType::class,
                DateType::class,
                TimezoneType::class,
                TimeType::class,
                WeekType::class,
            ],
            'money' => [
                CurrencyType::class,
                MoneyType::class,
            ],
            'number' => [
                IntegerType::class,
                NumberType::class,
                PercentType::class,
            ],
            'other' => [
                ColorType::class,
                FileType::class,
                HiddenType::class,
                PasswordType::class,
                RangeType::class,
            ],
        ];
    }
}
