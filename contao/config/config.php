<?php

declare(strict_types=1);

use Oneup\ContaoFormBundle\Model\FieldModel;
use Oneup\ContaoFormBundle\Model\FormModel;
use Oneup\ContaoFormBundle\Model\ConstraintModel;
use Oneup\ContaoFormBundle\Model\SubmissionModel;

$GLOBALS['BE_MOD']['content']['oneup_form'] = [
    'tables' => [
        'tl_oneup_form',
        'tl_oneup_form_field',
        'tl_oneup_form_constraint',
        'tl_oneup_form_submission',
    ],
];

$GLOBALS['TL_MODELS']['tl_oneup_form'] = FormModel::class;
$GLOBALS['TL_MODELS']['tl_oneup_form_field'] = FieldModel::class;
$GLOBALS['TL_MODELS']['tl_oneup_form_constraint'] = ConstraintModel::class;
$GLOBALS['TL_MODELS']['tl_oneup_form_submission'] = SubmissionModel::class;
