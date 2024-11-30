<?php

declare(strict_types=1);

use Contao\DataContainer;
use Contao\DC_Table;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

$GLOBALS['TL_DCA']['tl_symfony_form_field'] = [
    'config' => [
        'dataContainer' => DC_Table::class,
        'enableVersioning' => true,
        'ptable' => 'tl_symfony_form',
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
                'href' => 'act=edit',
                'icon' => 'edit.svg',
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
            'toggle' => [
                'href' => 'act=toggle&amp;field=published',
                'icon' => 'visible.svg',
            ],
            'show' => [
                'href' => 'act=show',
                'icon' => 'show.svg',
            ],
        ],
    ],

    'palettes' => [
        '__selector__' => ['type'],
        'default' => '{title_legend},name,type',
        TextType::class => '{title_legend},name,type;{publish_legend},published',
        TextareaType::class => '{title_legend},name,type;{publish_legend},published',
        HiddenType::class => '{title_legend},name,type;{publish_legend},published',
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
        'published' => [
            'inputType' => 'checkbox',
            'eval' => [
                'doNotCopy' => true,
                'tl_class' => 'w50',
            ],
            'toggle' => true,
            // 'save_callback' => [static fn ($v) => '1' === $v],
            'sql' => [
                'type' => Types::STRING,
                'length' => 1,
                'default' => '',
            ],
        ],
    ],
];
