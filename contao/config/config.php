<?php

declare(strict_types=1);

use Oneup\ContaoFormBundle\Model\FormFieldModel;
use Oneup\ContaoFormBundle\Model\FormModel;
use Oneup\ContaoFormBundle\Model\FormValidatorModel;

$GLOBALS['BE_MOD']['content']['oneup_form'] = [
    'tables' => [
        'tl_oneup_form',
        'tl_oneup_form_field',
        'tl_oneup_form_validator',
    ],
];

$GLOBALS['TL_MODELS']['tl_oneup_form'] = FormModel::class;
$GLOBALS['TL_MODELS']['tl_oneup_form_field'] = FormFieldModel::class;
$GLOBALS['TL_MODELS']['tl_oneup_form_validator'] = FormValidatorModel::class;
