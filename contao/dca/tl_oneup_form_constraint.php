<?php

declare(strict_types=1);

use Contao\DataContainer;
use Contao\DC_Table;
use Doctrine\DBAL\Types\Types;

$GLOBALS['TL_DCA']['tl_oneup_form_constraint'] = [
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

        'blank' => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        'notBlank' => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        'isTrue' => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        'regex' => '
            {title_legend},type;
            {option_legend},pattern,matchPattern;
            {message_legend},overwriteMessage;
        ',
        'cssColor' => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        'email' => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        'length' => '
            {title_legend},type;
            {option_legend},min,max;
            {message_legend},overwriteMessage;
        ',
        'noSuspiciousCharacters' => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        'passwordStrength' => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        'url' => '
            {title_legend},type;
            {option_legend},requireTopLevelDomain;
            {message_legend},overwriteMessage;
        ',
        'wordCount' => '
            {title_legend},type;
            {option_legend},min,max;
            {message_legend},overwriteMessage;
        ',
        'divisibleBy' => '
            {title_legend},type;
            {option_legend},value;
            {message_legend},overwriteMessage;
        ',
        'equalTo' => '
            {title_legend},type;
            {option_legend},value;
            {message_legend},overwriteMessage;
        ',
        'greaterThan' => '
            {title_legend},type;
            {option_legend},value;
            {message_legend},overwriteMessage;
        ',
        'greaterThanOrEqual' => '
            {title_legend},type;
            {option_legend},value;
            {message_legend},overwriteMessage;
        ',
        'lessThan' => '
            {title_legend},type;
            {option_legend},value;
            {message_legend},overwriteMessage;
        ',
        'lessThanOrEqual' => '
            {title_legend},type;
            {option_legend},value;
            {message_legend},overwriteMessage;
        ',
        'notEqualTo' => '
            {title_legend},type;
            {option_legend},value;
            {message_legend},overwriteMessage;
        ',
        'range' => '
            {title_legend},type;
            {option_legend},min,max;
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
        'date' => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        'dateTime' => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        'time' => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        'country' => '
            {title_legend},type;
            {message_legend},overwriteMessage;
        ',
        'file' => '
            {title_legend},type;
            {option_legend},maxSize,extensions;
            {message_legend},overwriteMessage;
        ',
        'image' => '
            {title_legend},type;
            {option_legend},maxSize,extensions,minWidth,maxWidth,minHeight,maxHeight;
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
            'reference' => &$GLOBALS['TL_LANG']['tl_oneup_form_constraint']['types'],
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
                'type' => Types::STRING,
                'default' => '',
            ],
        ],
        'value' => [
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
        'min' => [
            'inputType' => 'text',
            'eval' => [
                'rgxp' => 'digit',
                'tl_class' => 'w50',
            ],
            'sql' => [
                'type' => Types::INTEGER,
                'notnull' => false,
            ],
        ],
        'max' => [
            'inputType' => 'text',
            'eval' => [
                'rgxp' => 'digit',
                'tl_class' => 'w50',
            ],
            'sql' => [
                'type' => Types::INTEGER,
                'notnull' => false,
            ],
        ],
        'pattern' => [
            'inputType' => 'text',
            'eval' => [
                'mandatory' => true,
                'tl_class' => 'clr',
            ],
            'sql' => [
                'type' => Types::STRING,
                'default' => '',
            ],
        ],
        'matchPattern' => [
            'inputType' => 'checkbox',
            'eval' => [
                'tl_class' => 'clr',
            ],
            'sql' => [
                'type' => Types::BOOLEAN,
                'default' => true,
            ],
        ],
        'requireTopLevelDomain' => [
            'inputType' => 'checkbox',
            'eval' => [
                'tl_class' => 'clr',
            ],
            'sql' => [
                'type' => Types::BOOLEAN,
                'default' => true,
            ],
        ],
        'maxSize' => [
            'inputType' => 'text',
            'eval' => [
                'maxlength' => 16,
                'tl_class' => 'w50',
            ],
            'sql' => [
                'type' => Types::STRING,
                'default' => '',
            ],
        ],
        'extensions' => [
            'inputType' => 'text',
            'eval' => [
                'maxlength' => 255,
                'tl_class' => 'w50',
            ],
            'sql' => [
                'type' => Types::STRING,
                'default' => '',
            ],
        ],
        'minWidth' => [
            'inputType' => 'text',
            'eval' => [
                'rgxp' => 'natural',
                'tl_class' => 'w50',
            ],
            'sql' => [
                'type' => Types::INTEGER,
                'notnull' => false,
            ],
        ],
        'maxWidth' => [
            'inputType' => 'text',
            'eval' => [
                'rgxp' => 'natural',
                'tl_class' => 'w50',
            ],
            'sql' => [
                'type' => Types::INTEGER,
                'notnull' => false,
            ],
        ],
        'minHeight' => [
            'inputType' => 'text',
            'eval' => [
                'rgxp' => 'natural',
                'tl_class' => 'w50',
            ],
            'sql' => [
                'type' => Types::INTEGER,
                'notnull' => false,
            ],
        ],
        'maxHeight' => [
            'inputType' => 'text',
            'eval' => [
                'rgxp' => 'natural',
                'tl_class' => 'w50',
            ],
            'sql' => [
                'type' => Types::INTEGER,
                'notnull' => false,
            ],
        ],
    ],
];
