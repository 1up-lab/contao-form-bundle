<?php

declare(strict_types=1);

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

$GLOBALS['TL_LANG']['tl_oneup_form_field'] = [
    // Legends
    'title_legend' => 'Form field',
    'label_legend' => 'Label and Placeholder',
    'help_legend' => 'Help Text',
    'expert_legend' => 'Expert settings',
    'publish_legend' => 'Publish settings',

    // Fields
    'type' => ['Type', 'Please select a type'],
    'name' => ['Name', 'Internal name for this field, will not be shown in the frontend'],
    'required' => ['Required', 'A * will be shown in the frontend indicating that this field is required'],
    'trim' => ['Trim', 'If true, the whitespace at the start and at the end of the submitted string value will be stripped.'],
    'placeholder' => ['Placeholder', 'The placeholder attribute defines the text displayed in a form control when the control has no value.'],
    'label' => ['Label', 'The label represents a caption for an item in a user interface.'],
    'labelHtml' => ['Use HTML in Label', 'Will switch the label text field for an RTE field, allowing you to insert HTML elements like links.'],
    'help' => ['Help', 'The help text will be displayed under the corresponding form field'],
    'helpHtml' => ['Use HTML in help', 'Will switch the label text field for an RTE field, allowing you to insert HTML elements like links.'],
    'published' => ['Published', 'Output this field to the frontend.'],

    // Options & Groups
    'types' => [
        // Groups
        'text' => 'Text fields',
        'buttons' => 'Buttons',
        'choice' => 'Choices',
        'date' => 'Date and Time',
        'money' => 'Money',
        'number' => 'Numbers',
        'other' => 'Other fields',

        // Options
        BirthdayType::class => 'Birthday',
        ButtonType::class => 'Button',
        CheckboxType::class => 'Checkbox',
        ChoiceType::class => 'Choice',
        ColorType::class => 'Color',
        CountryType::class => 'Country',
        CurrencyType::class => 'Currency',
        DateIntervalType::class => 'Date Interval',
        DateTimeType::class => 'Date and Time',
        DateType::class => 'Date',
        EmailType::class => 'E-Mail',
        FileType::class => 'File',
        HiddenType::class => 'Hidden',
        IntegerType::class => 'Integer',
        LanguageType::class => 'Language',
        MoneyType::class => 'Money',
        NumberType::class => 'Number',
        PasswordType::class => 'Password',
        PercentType::class => 'Percent',
        RadioType::class => 'Radio',
        RangeType::class => 'Range',
        ResetType::class => 'Reset',
        SearchType::class => 'Search',
        SubmitType::class => 'Submit',
        TelType::class => 'Telephone',
        TextType::class => 'Text',
        TextareaType::class => 'Textarea',
        TimeType::class => 'Time',
        TimezoneType::class => 'Timezone',
        UrlType::class => 'Url',
        WeekType::class => 'Week',
    ],
];
