<?php

declare(strict_types=1);

use Contao\DataContainer;
use Contao\DC_Table;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Form\Extension\Core\Type\TextType;

$GLOBALS['TL_DCA']['tl_oneup_form_field'] = [
    'config' => [
        'dataContainer' => DC_Table::class,
        'enableVersioning' => true,
        'dynamicPtable' => true,
        'ptable' => 'tl_oneup_form',
        'ctable' => ['tl_oneup_form_field', 'tl_oneup_form_validator'],
        'sql' => [
            'keys' => [
                'id' => 'primary',
                'pid' => 'index',
                'type' => 'index',
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
            'constraints' => [
                'primary' => true,
                'href' => 'table=tl_oneup_form_validator',
                'icon' => 'diffTemplate.svg',
            ],
            'copy',
            'delete',
            'toggle',
            'show',
        ],
    ],

    'palettes' => [
        '__selector__' => ['type'],
        // You need every field in the default palette, otherwise they will not be persisted to the database
        'default' => 'type,name,',

        'birthday' => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        'button' => '
            {title_legend},name,type,alias;
            {label_legend},label;
            {publish_legend},published;
        ',
        'checkbox' => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        'choice' => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        'color' => '
            {title_legend},name,type,alias;
            {label_legend},label;
            {config_legend},html5;
            {publish_legend},published;
        ',
        'country' => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        'currency' => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        'dateInterval' => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        'dateTime' => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        'date' => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        'mail' => '
            {title_legend},name,type,alias;
            {label_legend},placeholder,label,labelHtml;
            {help_legend},help,helpHtml;
            {expert_legend},required,trim;
            {publish_legend},published;
        ',
        'file' => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        'group' => '
            {title_legend},name,type,alias;
            {publish_legend},published;
        ',
        'hidden' => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        'integer' => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        'language' => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        'money' => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        'number' => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        'password' => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        'percent' => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        'radio' => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        'range' => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        'reset' => '
            {title_legend},name,type,alias;
            {label_legend},label;
            {publish_legend},published;
        ',
        'search' => '
            {title_legend},name,type,alias;
            {label_legend},placeholder,label,labelHtml;
            {help_legend},help,helpHtml;
            {expert_legend},required,trim;
            {publish_legend},published;
        ',
        'submit' => '
            {title_legend},name,type,alias;
            {label_legend},label;
            {publish_legend},published;
        ',
        'tel' => '
            {title_legend},name,type,alias;
            {label_legend},placeholder,label,labelHtml;
            {help_legend},help,helpHtml;
            {expert_legend},required,trim;
            {publish_legend},published;
        ',
        'text' => '
            {title_legend},name,type,alias;
            {label_legend},placeholder,label,labelHtml;
            {help_legend},help,helpHtml;
            {expert_legend},required,trim;
            {publish_legend},published;
        ',
        'textarea' => '
            {title_legend},name,type,alias;
            {label_legend},placeholder,label,labelHtml;
            {help_legend},help,helpHtml;
            {expert_legend},required,trim;
            {publish_legend},published;
        ',
        'time' => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        'timezone' => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        'url' => '
            {title_legend},name,type,alias;
            {label_legend},placeholder,label,labelHtml;
            {help_legend},help,helpHtml;
            {config_legend},defaultProtocol;
            {expert_legend},required,trim;
            {publish_legend},published;
        ',
        'week' => '
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
        'ptable' => [
            'sql' => [
                'type' => Types::STRING,
                'default' => '',
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
        'alias' => [
            'inputType' => 'text',
            'eval' => [
                'readonly' => true,
                'tl_class' => 'w50',
            ],
            'sql' => [
                'type' => Types::STRING,
                'default' => '',
            ],
        ],
        'type' => [
            'inputType' => 'select',
            'reference' => &$GLOBALS['TL_LANG']['tl_oneup_form_field']['types'],
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
        ],
        'label' => [
            'inputType' => 'text',
            'eval' => [
                'mandatory' => false,
                'tl_class' => 'clr',
            ],
        ],
        'labelHtml' => [
            'inputType' => 'checkbox',
            'eval' => [
                'submitOnChange' => true,
                'tl_class' => 'w50',
            ],
        ],
        'help' => [
            'inputType' => 'text',
            'eval' => [
                'mandatory' => false,
                'tl_class' => 'clr',
            ],
        ],
        'helpHtml' => [
            'inputType' => 'checkbox',
            'eval' => [
                'submitOnChange' => true,
                'tl_class' => 'w50',
            ],
        ],
        'trim' => [
            'inputType' => 'checkbox',
            'eval' => [
                'tl_class' => 'clr',
            ],
        ],
        'required' => [
            'inputType' => 'checkbox',
            'eval' => [
                'tl_class' => 'clr',
            ],
        ],
        'defaultProtocol' => [
            'inputType' => 'select',
            'options' => [
                'file://',
                'ftp://',
                'https://',
                'http://',
                'imap://',
                'irc://',
                'nntp://',
                'wss://',
            ],
            'eval' => [
                'chosen' => true,
                'mandatory' => true,
                'tl_class' => 'w50',
            ],
        ],
        'html5' => [
            'inputType' => 'checkbox',
            'eval' => [
                'tl_class' => 'clr',
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
