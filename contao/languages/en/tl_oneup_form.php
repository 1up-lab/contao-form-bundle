<?php

declare(strict_types=1);

$GLOBALS['TL_LANG']['tl_oneup_form'] = [
    // Legends
    'title_legend' => 'Form settings',
    'jumpTo_legend' => 'Redirect settings',
    'submission_legend' => 'Submission settings',

    // Operations
    'submissions' => ['Submissions', 'Show all submitted form data for form %s'],

    // Fields
    'name' => ['Name', 'Internal name for this form, will not be shown in the frontend'],
    'jumpTo' => ['Redirect page', 'Please choose the page to which visitors will be redirected after submitting the form.'],
    'storeSubmissions' => ['Store submission', 'Please choose if you want to store the data of all form submissions.'],
    'submissionExpression' => ['Expression', 'Expression-Syntax, use <code>data</code> to access the underlying object.'],
];
