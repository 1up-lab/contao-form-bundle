<?php

declare(strict_types=1);

use Contao\DataContainer;
use Contao\DC_Table;
use Doctrine\DBAL\Types\Types;
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

$GLOBALS['TL_DCA']['tl_symfony_form_field'] = [
    'config' => [
        'dataContainer' => DC_Table::class,
        'enableVersioning' => true,
        'ptable' => 'tl_symfony_form',
        'ctable' => ['tl_symfony_form_validator'],
        'sql' => [
            'keys' => [
                'id' => 'primary',
                'pid' => 'index',
            ],
        ],
    ],

    'list' => [
        'sorting' => [
            'mode' => DataContainer::MODE_PARENT,
            'fields' => ['sorting'],
            'headerFields' => ['name'],
            'panelLayout' => 'filter;sort,search,limit',
        ],
        'label' => [
            'fields' => ['name', 'type'],
            'showColumns' => false,
            'format' => ' %s <small style="color:#aaa;">[%s]</small>',
        ],
        'global_operations' => [
            'all',
        ],
        'operations' => [
            'edit',
            'children',
            'copy',
            'delete',
            'toggle',
            'show',
        ],
    ],

    'palettes' => [
        '__selector__' => ['type'],
        'default' => '{title_legend},name,type',

        BirthdayType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        ButtonType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        CheckboxType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        ChoiceType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        ColorType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        CountryType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        CurrencyType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        DateIntervalType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        DateTimeType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        DateType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        EmailType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        FileType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        HiddenType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        IntegerType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        LanguageType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        MoneyType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        NumberType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        PasswordType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        PercentType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        RadioType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        RangeType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        ResetType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        SearchType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        SubmitType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        TelType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        TextType::class => '
            {title_legend},name,type;
            {label_legend},placeholder,label,labelHtml;
            {help_legend},help,helpHtml;
            {expert_legend},required,trim;
            {publish_legend},published;
        ',
        TextareaType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        TimeType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        TimezoneType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        UrlType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        WeekType::class => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
    ],

    'fields' => [
        'id' => [
            'sql' => [
                'type' => Types::INTEGER,
                'unsigned' => true,
                'autoIncrement' => true,
            ],
        ],
        'pid' => [
            'foreignKey' => 'tl_symfony_form.id',
            'sql' => [
                'type' => Types::INTEGER,
                'unsigned' => true,
            ],
            'relation' => [
                'type' => 'belongsTo',
                'load' => 'eager',
            ],
        ],
        'tstamp' => [
            'sql' => [
                'type' => Types::INTEGER,
                'unsigned' => true,
                'default' => 0,
            ],
        ],
        'sorting' => [
            'sql' => [
                'type' => Types::INTEGER,
                'unsigned' => true,
                'default' => 0,
            ],
        ],
        'name' => [
            'inputType' => 'text',
            'eval' => [
                'mandatory' => true,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ],
            'sql' => [
                'type' => Types::STRING,
                'default' => '',
            ],
        ],
        'type' => [
            'inputType' => 'select',
            'reference' => &$GLOBALS['TL_LANG']['tl_symfony_form_field']['types'],
            'eval' => [
                'chosen' => true,
                'mandatory' => true,
                'submitOnChange' => true,
                'tl_class' => 'w50',
            ],
            'sql' => [
                'type' => Types::STRING,
                'default' => TextType::class,
            ],
        ],
        'placeholder' => [
            'inputType' => 'text',
            'eval' => [
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'clr',
            ],
            'sql' => [
                'type' => Types::STRING,
                'default' => '',
            ],
        ],
        'label' => [
            'inputType' => 'text',
            'eval' => [
                'mandatory' => false,
                'tl_class' => 'clr',
            ],
            'sql' => [
                'type' => Types::TEXT,
                'default' => '',
            ],
        ],
        'labelHtml' => [
            'inputType' => 'checkbox',
            'eval' => [
                'submitOnChange' => true,
                'tl_class' => 'w50',
            ],
            'sql' => [
                'type' => Types::BOOLEAN,
                'default' => false,
            ],
        ],
        'help' => [
            'inputType' => 'text',
            'eval' => [
                'mandatory' => false,
                'tl_class' => 'clr',
            ],
            'sql' => [
                'type' => Types::TEXT,
                'default' => '',
            ],
        ],
        'helpHtml' => [
            'inputType' => 'checkbox',
            'eval' => [
                'submitOnChange' => true,
                'tl_class' => 'w50',
            ],
            'sql' => [
                'type' => Types::BOOLEAN,
                'default' => false,
            ],
        ],
        'trim' => [
            'inputType' => 'checkbox',
            'eval' => [
                'tl_class' => 'clr',
            ],
            'sql' => [
                'type' => Types::BOOLEAN,
                'default' => false,
            ],
        ],
        'required' => [
            'inputType' => 'checkbox',
            'eval' => [
                'tl_class' => 'clr',
            ],
            'sql' => [
                'type' => Types::BOOLEAN,
                'default' => false,
            ],
        ],
        'published' => [
            'inputType' => 'checkbox',
            'eval' => [
                'doNotCopy' => true,
                'tl_class' => 'w50',
            ],
            'toggle' => true,
            'sql' => [
                'type' => Types::BOOLEAN,
                'default' => false,
            ],
        ],
    ],
];
