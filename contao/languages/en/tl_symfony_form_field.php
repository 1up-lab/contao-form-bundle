<?php

declare(strict_types=1);

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

$GLOBALS['TL_LANG']['tl_symfony_form_field'] = [
    // Legends
    'title_legend' => 'Title',
    'publish_legend' => 'Publish settings',

    // Fields
    'type' => ['Type', 'Please select a type'],
    'name' => ['Name', 'Internal name for this field, will not be shown in the frontend'],

    // Options
    'types' => [
        TextType::class => 'Text',
        TextareaType::class => 'Textarea',
        HiddenType::class => 'Hidden',
    ],
];
