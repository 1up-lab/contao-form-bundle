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

$GLOBALS['TL_DCA']['tl_symfony_form_validator'] = [
    'config' => [
        'dataContainer' => DC_Table::class,
        'enableVersioning' => true,
        'ptable' => 'tl_symfony_form_field',
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
            'all' => [
                'href' => 'act=select',
                'class' => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"',
            ],
        ],
        'operations' => [
            'edit' => [
                'href' => 'act=edit',
                'icon' => 'edit.svg',
            ],
            'delete' => [
                'href' => 'act=delete',
                'icon' => 'delete.svg',
                'attributes' => 'onclick="if(!confirm(\'' . ($GLOBALS['TL_LANG']['MSC']['deleteConfirm'] ?? '') . '\'))return false;Backend.getScrollOffset()"',
            ],
            'show' => [
                'href' => 'act=show',
                'icon' => 'show.svg',
            ],
        ],
    ],

    'palettes' => [
        '__selector__' => ['type', 'overwriteMessage'],
        'default' => '{title_legend},type',

        NotBlank::class => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        Regex::class => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        DivisibleBy::class => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        EqualTo::class => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        GreaterThan::class => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        GreaterThanOrEqual::class => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        LessThan::class => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        LessThanOrEqual::class => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        NotEqualTo::class => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        Range::class => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        Negative::class => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        NegativeOrZero::class => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        Positive::class => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        PositiveOrZero::class => '
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
            'foreignKey' => 'tl_symfony_form_field.id',
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
            'reference' => &$GLOBALS['TL_LANG']['tl_symfony_form_validator']['types'],
            'eval' => [
                'chosen' => true,
                'mandatory' => true,
                'submitOnChange' => true,
                'tl_class' => 'w50',
            ],
            'sql' => [
                'type' => Types::STRING,
                'default' => NotBlank::class,
            ],
        ],
        'overwriteMessage' => [
            'inputType' => 'checkbox',
            'eval' => [
                'submitOnChange' => true,
                'tl_class' => 'clr',
            ],
            'sql' => [
                'type' => Types::BOOLEAN,
                'default' => false,
            ],
        ],
        'message' => [
            'inputType' => 'text',
            'eval' => [
                'mandatory' => true,
                'tl_class' => 'clr',
            ],
            'sql' => [
                'type' => Types::TEXT,
                'default' => '',
            ],
        ],
    ],
];
