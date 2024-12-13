<?php

declare(strict_types=1);

use Doctrine\DBAL\Types\Types;

$GLOBALS['TL_DCA']['tl_content']['palettes'] = [
    ...$GLOBALS['TL_DCA']['tl_content']['palettes'],
    ...[
        'oneup_form' => '
            {type_legend},type,headline;
            {include_legend},oneup_form;
            {invisible_legend:hide},invisible,start,stop;
        ',
    ],
];

$GLOBALS['TL_DCA']['tl_content']['fields'] = [
    ...$GLOBALS['TL_DCA']['tl_content']['fields'],
    ...[
        'oneup_form' => [
            'inputType' => 'select',
            'exclude' => true,
            'eval' => [
                'mandatory' => true,
                'chosen' => true,
                'tl_class' => 'w50 wizard',
            ],
            'sql' => [
                'type' => Types::INTEGER,
                'notnull' => false,
            ],
        ],
    ],
];
