<?php

declare(strict_types=1);

$GLOBALS['TL_LANG']['tl_oneup_form_constraint'] = [
    // Legends
    'title_legend' => 'Constraint',
    'message_legend' => 'Error Message',

    // Fields
    'type' => ['Type', 'Please select a type'],
    'overwriteMessage' => ['Define custom message', 'Overwrite the default error message'],
    'message' => ['Message', 'The error message that is displayed if this constraint fails to validate.'],

    // Options & Groups
    'types' => [
        // Groups
        'basic' => 'Basic',
        'string' => 'String',
        'comparison' => 'Comparison',
        'number' => 'Number',

        // Options
        'notBlank' => 'Not Blank',
        'regex' => 'Regex',
        'divisibleBy' => 'Divisible by',
        'equalTo' => 'Equal to',
        'greaterThan' => 'Greater than',
        'greaterThanOrEqual' => 'Greater than or equal',
        'lessThan' => 'Less than',
        'lessThanOrEqual' => 'Less than or equal',
        'notEqualTo' => 'Not equal to',
        'range' => 'Range',
        'negative' => 'Negative',
        'negativeOrZero' => 'Negative or zero',
        'positive' => 'Positive',
        'positiveOrZero' => 'Positive or zero',
    ],
];
