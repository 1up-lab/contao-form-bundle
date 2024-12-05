<?php

declare(strict_types=1);

use Symfony\Component\Validator\Constraints\DivisibleBy;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\Negative;
use Symfony\Component\Validator\Constraints\NegativeOrZero;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotEqualTo;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\PositiveOrZero;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Validator\Constraints\Regex;

$GLOBALS['TL_LANG']['tl_oneup_form_validator'] = [
    // Legends
    'title_legend' => 'Validator',
    'message_legend' => 'Error Message',

    // Fields
    'type' => ['Type', 'Please select a type'],
    'overwriteMessage' => ['Define custom message', 'Overwrite the default error message'],
    'message' => ['Message', 'The error message that is displayed if this validator fails to validate.'],

    // Options & Groups
    'types' => [
        // Groups
        'basic' => 'Basic',
        'string' => 'String',
        'comparison' => 'Comparison',
        'number' => 'Number',

        // Options
        NotBlank::class => 'Not Blank',
        Regex::class => 'Regex',
        DivisibleBy::class => 'Divisible by',
        EqualTo::class => 'Equal to',
        GreaterThan::class => 'Greater than',
        GreaterThanOrEqual::class => 'Greater than or equal',
        LessThan::class => 'Less than',
        LessThanOrEqual::class => 'Less than or equal',
        NotEqualTo::class => 'Not equal to',
        Range::class => 'Range',
        Negative::class => 'Negative',
        NegativeOrZero::class => 'Negative or zero',
        Positive::class => 'Positive',
        PositiveOrZero::class => 'Positive or zero',
    ],
];
