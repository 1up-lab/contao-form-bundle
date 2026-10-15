<?php

declare(strict_types=1);

use Contao\DataContainer;
use Contao\DC_Table;
use Doctrine\DBAL\Platforms\AbstractMySQLPlatform;
use Doctrine\DBAL\Types\Types;

$GLOBALS['TL_DCA']['tl_oneup_form_field'] = [
    'config' => [
        'dataContainer' => DC_Table::class,
        'enableVersioning' => true,
        'dynamicPtable' => true,
        'ptable' => 'tl_oneup_form',
        'ctable' => ['tl_oneup_form_field', 'tl_oneup_form_constraint'],
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
                'href' => 'table=tl_oneup_form_constraint',
                'icon' => 'diffTemplate.svg',
            ],
            'copy',
            'delete',
            'toggle',
            'show',
        ],
    ],

    'palettes' => [
        '__selector__' => ['type', 'storeFile'],
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
            {title_legend},name,type,alias;
            {label_legend},label,labelHtml;
            {help_legend},help,helpHtml;
            {config_legend},checked;
            {expert_legend},required;
            {publish_legend},published;
        ',
        'choice' => '
            {title_legend},name,type,alias;
            {label_legend},placeholder,label,labelHtml;
            {help_legend},help,helpHtml;
            {options_legend},options;
            {config_legend},expanded,multiple;
            {expert_legend},required;
            {publish_legend},published;
        ',
        'color' => '
            {title_legend},name,type,alias;
            {label_legend},label;
            {config_legend},html5;
            {publish_legend},published;
        ',
        'country' => '
            {title_legend},name,type,alias;
            {label_legend},placeholder,label,labelHtml;
            {help_legend},help,helpHtml;
            {options_legend},preferredChoices,duplicatePreferredChoices;
            {config_legend},expanded,multiple,alpha3;
            {expert_legend},required;
            {publish_legend},published;
        ',
        'currency' => '
            {title_legend},name,type,alias;
            {label_legend},placeholder,label,labelHtml;
            {help_legend},help,helpHtml;
            {options_legend},preferredChoices,duplicatePreferredChoices;
            {config_legend},expanded,multiple;
            {expert_legend},required;
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
        'email' => '
            {title_legend},name,type,alias;
            {label_legend},placeholder,label,labelHtml;
            {help_legend},help,helpHtml;
            {expert_legend},required,trim;
            {publish_legend},published;
        ',
        'file' => '
            {title_legend},name,type;
            {config_legend},multipleFiles,attachToEmail,storeFile;
            {publish_legend},published;
        ',
        'group' => '
            {title_legend},name,type,alias;
            {publish_legend},published;
        ',
        'hidden' => '
            {title_legend},name,type;
            {config_legend},value;
            {publish_legend},published;
        ',
        'integer' => '
            {title_legend},name,type,alias;
            {label_legend},placeholder,label,labelHtml;
            {help_legend},help,helpHtml;
            {expert_legend},required;
            {publish_legend},published;
        ',
        'language' => '
            {title_legend},name,type,alias;
            {label_legend},placeholder,label,labelHtml;
            {help_legend},help,helpHtml;
            {options_legend},preferredChoices,duplicatePreferredChoices;
            {config_legend},expanded,multiple,alpha3;
            {expert_legend},required;
            {publish_legend},published;
        ',
        'money' => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        'number' => '
            {title_legend},name,type,alias;
            {label_legend},placeholder,label,labelHtml;
            {help_legend},help,helpHtml;
            {config_legend},html5;
            {expert_legend},required;
            {publish_legend},published;
        ',
        'password' => '
            {title_legend},name,type;
            {publish_legend},published;
        ',
        'percent' => '
            {title_legend},name,type,alias;
            {label_legend},placeholder,label,labelHtml;
            {help_legend},help,helpHtml;
            {config_legend},html5;
            {expert_legend},required;
            {publish_legend},published;
        ',
        'radio' => '
            {title_legend},name,type,alias;
            {label_legend},label,labelHtml;
            {help_legend},help,helpHtml;
            {config_legend},checked;
            {expert_legend},required;
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
        'step' => '
            {title_legend},name,type,alias;
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
            {title_legend},name,type,alias;
            {label_legend},placeholder,label,labelHtml;
            {help_legend},help,helpHtml;
            {options_legend},preferredChoices,duplicatePreferredChoices;
            {config_legend},expanded,multiple;
            {expert_legend},required;
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
        'altcha' => '
            {title_legend},name,type;
            {config_legend,altchaAuto,altchaHideLogo,altchaHideFooter,altchaFloating;
            {publish_legend},published;
        ',
    ],

    'subpalettes' => [
        'storeFile' => 'uploadFolder,useHomeDir,doNotOverwrite,addBackendLink',
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
                'doNotCopy' => true,
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
                'default' => 'text',
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
                'length' => AbstractMySQLPlatform::LENGTH_LIMIT_MEDIUMTEXT,
                'notnull' => false,
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
                'length' => AbstractMySQLPlatform::LENGTH_LIMIT_MEDIUMTEXT,
                'notnull' => false,
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
                'default' => true,
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
            'sql' => [
                'type' => Types::STRING,
                'default' => 'https://',
            ],
        ],
        'checked' => [
            'inputType' => 'checkbox',
            'eval' => [
                'tl_class' => 'w50',
            ],
            'sql' => [
                'type' => Types::BOOLEAN,
                'default' => false,
            ],
        ],
        'value' => [
            'inputType' => 'text',
            'eval' => [
                'mandatory' => false,
                'maxlength' => 255,
                'tl_class' => 'w50',
            ],
            'sql' => [
                'type' => Types::STRING,
                'default' => '',
            ],
        ],
        'options' => [
            'inputType' => 'optionWizard',
            'eval' => [
                'mandatory' => true,
                'allowHtml' => true,
                'tl_class' => 'clr',
            ],
            'sql' => [
                'type' => Types::BLOB,
                'notnull' => false,
            ],
        ],
        'preferredChoices' => [
            'inputType' => 'select',
            'eval' => [
                'multiple' => true,
                'chosen' => true,
                'tl_class' => 'clr',
            ],
            'sql' => [
                'type' => Types::BLOB,
                'notnull' => false,
            ],
        ],
        'duplicatePreferredChoices' => [
            'inputType' => 'checkbox',
            'eval' => [
                'tl_class' => 'w50 clr',
            ],
            'sql' => [
                'type' => Types::BOOLEAN,
                'default' => true,
            ],
        ],
        'expanded' => [
            'inputType' => 'checkbox',
            'eval' => [
                'tl_class' => 'w50 clr',
            ],
            'sql' => [
                'type' => Types::BOOLEAN,
                'default' => false,
            ],
        ],
        'multiple' => [
            'inputType' => 'checkbox',
            'eval' => [
                'tl_class' => 'w50',
            ],
            'sql' => [
                'type' => Types::BOOLEAN,
                'default' => false,
            ],
        ],
        'alpha3' => [
            'inputType' => 'checkbox',
            'eval' => [
                'tl_class' => 'w50',
            ],
            'sql' => [
                'type' => Types::BOOLEAN,
                'default' => false,
            ],
        ],
        'html5' => [
            'inputType' => 'checkbox',
            'eval' => [
                'tl_class' => 'clr',
            ],
            'sql' => [
                'type' => Types::BOOLEAN,
                'default' => false,
            ],
        ],
        'altchaAuto' => [
            'inputType' => 'select',
            'options' => [
                'onfocus', 'onsubmit',
            ],
            'eval' => [
                'includeBlankOption' => true,
                'tl_class' => 'w50',
            ],
            'sql' => [
                'type' => Types::STRING,
                'length' => 12,
                'default' => '',
            ],
        ],
        'altchaFloating' => [
            'inputType' => 'checkbox',
            'eval' => [
                'tl_class' => 'w16',
            ],
            'sql' => [
                'type' => Types::BOOLEAN,
                'default' => false,
            ],
        ],
        'altchaHideLogo' => [
            'inputType' => 'checkbox',
            'eval' => ['tl_class' => 'w16'],
            'sql' => [
                'type' => Types::BOOLEAN,
                'default' => false,
            ],
        ],
        'altchaHideFooter' => [
            'inputType' => 'checkbox',
            'eval' => [
                'tl_class' => 'w16',
            ],
            'sql' => [
                'type' => Types::BOOLEAN,
                'default' => false,
            ],
        ],
        'multipleFiles' => [
            'inputType' => 'checkbox',
            'eval' => [
                'tl_class' => 'w50',
            ],
            'sql' => [
                'type' => Types::BOOLEAN,
                'default' => false,
            ],
        ],
        'attachToEmail' => [
            'inputType' => 'checkbox',
            'eval' => [
                'tl_class' => 'w50',
            ],
            'sql' => [
                'type' => Types::BOOLEAN,
                'default' => false,
            ],
        ],
        'storeFile' => [
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
        'uploadFolder' => [
            'inputType' => 'fileTree',
            'eval' => [
                'fieldType' => 'radio',
                'tl_class' => 'clr',
            ],
            'sql' => [
                'type' => Types::BINARY,
                'notnull' => false,
            ],
        ],
        'useHomeDir' => [
            'inputType' => 'checkbox',
            'eval' => [
                'tl_class' => 'w50',
            ],
            'sql' => [
                'type' => Types::BOOLEAN,
                'default' => false,
            ],
        ],
        'doNotOverwrite' => [
            'inputType' => 'checkbox',
            'eval' => [
                'tl_class' => 'w50',
            ],
            'sql' => [
                'type' => Types::BOOLEAN,
                'default' => false,
            ],
        ],
        'addBackendLink' => [
            'inputType' => 'checkbox',
            'eval' => [
                'tl_class' => 'w50',
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
