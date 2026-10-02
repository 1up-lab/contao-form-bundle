<?php

declare(strict_types=1);

use Contao\DataContainer;
use Contao\DC_Table;
use Doctrine\DBAL\Types\Types;

$GLOBALS['TL_DCA']['tl_oneup_form_submission'] = [
    'config' => [
        'dataContainer' => DC_Table::class,
        'enableVersioning' => false,
        'closed' => true,
        'notEditable' => true,
        'notDeletable' => false,
        'notCopyable' => true,
        'ptable' => 'tl_oneup_form',
        'sql' => [
            'keys' => [
                'id' => 'primary',
                'pid' => 'index',
            ],
        ],
    ],

    'list' => [
        'sorting' => [
            'mode' => DataContainer::MODE_SORTED,
            'flag' => DataContainer::SORT_DAY_DESC,
            'fields' => ['tstamp'],
            'headerFields' => ['name'],
            'panelLayout' => 'filter;sort,search,limit',
        ],
        'label' => [
            'fields' => ['tstamp', 'name'],
            'showColumns' => false,
            'format' => '<small style="color:#aaa;">[%s]</small> %s',
        ],
        'global_operations' => [
            'all',
        ],
        'operations' => [
            'delete',
            'show',
        ],
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
            'foreignKey' => 'tl_oneup_form.id',
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
        'name' => [
            'sql' => [
                'type' => Types::STRING,
                'default' => '',
            ],
        ],
        'data' => [
            'sql' => [
                'type' => Types::JSON,
            ],
        ],
    ],
];
