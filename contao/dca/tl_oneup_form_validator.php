<?php

declare(strict_types=1);

use Contao\DataContainer;
use Contao\DC_Table;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints\DivisibleBy;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\Negative;
use Symfony\Component\Validator\Constraints\NegativeOrZero;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotEqualTo;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\PositiveOrZero;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Validator\Constraints\Regex;

$GLOBALS['TL_DCA']['tl_oneup_form_validator'] = [
    'config' => [
        'dataContainer' => DC_Table::class,
        'enableVersioning' => true,
        'ptable' => 'tl_oneup_form_field',
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
            'headerFields' => ['name', 'type'],
            'panelLayout' => 'filter;sort,search,limit',
        ],
        'label' => [
            'fields' => ['type'],
            'showColumns' => false,
            'format' => '%s',
        ],
        'global_operations' => [
            'all',
        ],
        'operations' => [
            'edit',
            'delete',
            'show',
        ],
    ],

    'palettes' => [
        '__selector__' => ['type', 'overwriteMessage'],
        'default' => 'type',

        'notBlank' => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        'regex' => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        'divisibleBy' => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        'equalTo' => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        'greaterThan' => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        'greaterThanOrEqual' => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        'lessThan' => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        'lessThanOrEqual' => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        'notEqualTo' => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        'range' => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        'negative' => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        'negativeOrZero' => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        'positive' => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        'positiveOrZero' => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
    ],

    'subpalettes' => [
        'overwriteMessage' => 'message',
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
            'foreignKey' => 'tl_oneup_form_field.id',
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
        'type' => [
            'inputType' => 'select',
            'reference' => &$GLOBALS['TL_LANG']['tl_oneup_form_validator']['types'],
            'eval' => [
                'chosen' => true,
                'mandatory' => true,
                'submitOnChange' => true,
                'tl_class' => 'w50',
            ],
            'sql' => [
                'type' => Types::STRING,
                'default' => 'notBlank',
            ],
        ],
        'overwriteMessage' => [
            'inputType' => 'checkbox',
            'eval' => [
                'submitOnChange' => true,
                'tl_class' => 'clr',
            ],
        ],
        'message' => [
            'inputType' => 'text',
            'eval' => [
                'mandatory' => true,
                'tl_class' => 'clr',
            ],
        ],
    ],
];
