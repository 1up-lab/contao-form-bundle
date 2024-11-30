<?php

declare(strict_types=1);

use Contao\DataContainer;
use Contao\DC_Table;
use Doctrine\DBAL\Types\Types;

$GLOBALS['TL_DCA']['tl_symfony_form'] = [
    'config' => [
        'dataContainer' => DC_Table::class,
        'enableVersioning' => true,
        'ctable' => ['tl_symfony_form_field'],
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
            'all' => [
                'href' => 'act=select',
                'class' => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"',
            ],
        ],
        'operations' => [
            'edit' => [
                'href' => 'table=tl_symfony_form_field',
                'icon' => 'edit.svg',
                'attributes' => 'class="contextmenu"',
            ],
            'editheader' => [
                'href' => 'act=edit',
                'icon' => 'header.svg',
                'attributes' => 'class="edit-header"',
            ],
            'copy' => [
                'href' => 'act=copy',
                'icon' => 'copy.svg',
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
        '__selector__' => [],
        'default' => '{title_legend},name',
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
    ],
];
