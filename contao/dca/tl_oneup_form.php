<?php

declare(strict_types=1);

use Contao\DataContainer;
use Contao\DC_Table;
use Doctrine\DBAL\Types\Types;

$GLOBALS['TL_DCA']['tl_oneup_form'] = [
    'config' => [
        'dataContainer' => DC_Table::class,
        'enableVersioning' => true,
        'ctable' => ['tl_oneup_form_field'],
        'sql' => [
            'keys' => [
                'id' => 'primary',
            ],
        ],
    ],

    'list' => [
        'sorting' => [
            'mode' => DataContainer::MODE_SORTED,
            'fields' => ['name'],
            'flag' => 1,
            'panelLayout' => 'filter;sort,search,limit',
        ],
        'label' => [
            'fields' => ['name'],
            'format' => '%s',
            'showColumns' => false,
        ],
        'global_operations' => [
            'all',
        ],
        'operations' => [
            'edit',
            'children',
            'submissions' => [
                'primary' => true,
                'href' => 'table=tl_oneup_form_submission',
                'icon' => 'article.svg',
            ],
            'copy',
            'delete',
            'show',
        ],
    ],

    'palettes' => [
        '__selector__' => ['storeSubmissions'],
        'default' => '
            {title_legend},name,;
            {redirect_legend},jumpTo;
            {submission_legend},storeSubmissions;
            {multistep_legend},isMultistep;
        ',
    ],

    'subpalettes' => [
        'storeSubmissions' => 'submissionExpression',
    ],

    'fields' => [
        'id' => [
            'sql' => [
                'type' => Types::INTEGER,
                'unsigned' => true,
                'autoIncrement' => true,
            ],
        ],
        'tstamp' => [
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
        'storeSubmissions' => [
            'inputType' => 'checkbox',
            'eval' => [
                'submitOnChange' => true,
                'doNotCopy' => true,
                'tl_class' => 'w50',
            ],
            'sql' => [
                'type' => Types::BOOLEAN,
                'default' => false,
            ],
        ],
        'submissionExpression' => [
            'inputType' => 'text',
            'eval' => [
                'decodeEntities' => true,
                'mandatory' => true,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ],
        ],
        'jumpTo' => [
            'inputType' => 'pageTree',
            'foreignKey' => 'tl_page.title',
            'eval' => [
                'fieldType' => 'radio',
                'tl_class' => 'clr',
            ],
            'sql' => [
                'type' => Types::INTEGER,
                'unsigned' => true,
                'default' => 0,
            ],
            'relation' => [
                'type' => 'hasOne',
                'load' => 'lazy',
            ],
        ],
        'isMultistep' => [
            'inputType' => 'checkbox',
            'eval' => [
                'doNotCopy' => true,
                'tl_class' => 'w50',
            ],
            'sql' => [
                'type' => Types::BOOLEAN,
                'default' => false,
            ],
        ],
    ],
];
