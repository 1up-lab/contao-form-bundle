<?php

declare(strict_types=1);

$GLOBALS['TL_LANG']['tl_oneup_form_field'] = [
    // Legends
    'title_legend' => 'Form field',
    'label_legend' => 'Label and Placeholder',
    'help_legend' => 'Help Text',
    'expert_legend' => 'Expert settings',
    'publish_legend' => 'Publish settings',
    'config_legend' => 'Configuration',

    // Fields
    'type' => ['Type', 'Please select a type'],
    'name' => ['Name', 'Internal name for this field, will not be shown in the frontend'],
    'alias' => ['Alias', 'Internal representation of this field. Will be generated automatically.'],
    'required' => ['Required', 'A * will be shown in the frontend indicating that this field is required'],
    'trim' => ['Trim', 'If true, the whitespace at the start and at the end of the submitted string value will be stripped.'],
    'placeholder' => ['Placeholder', 'The placeholder attribute defines the text displayed in a form control when the control has no value.'],
    'label' => ['Label', 'The label represents a caption for an item in a user interface.'],
    'labelHtml' => ['Use HTML in Label', 'Will switch the label text field for an RTE field, allowing you to insert HTML elements like links.'],
    'help' => ['Help', 'The help text will be displayed under the corresponding form field'],
    'helpHtml' => ['Use HTML in help', 'Will switch the label text field for an RTE field, allowing you to insert HTML elements like links.'],
    'defaultProtocol' => ['Default Protocol', 'If no scheme is added to the url, use this protocol'],
    'html5' => ['Check format', 'If set, the value must match the HTML5 color format.'],
    'published' => ['Published', 'Output this field to the frontend.'],

    // Options & Groups
    'types' => [
        // Groups
        'texts' => 'Text fields',
        'buttons' => 'Buttons',
        'choices' => 'Choices',
        'dates' => 'Date and Time',
        'moneys' => 'Money',
        'numbers' => 'Numbers',
        'others' => 'Other fields',

        // Options
        'birthday' => 'Birthday',
        'button' => 'Button',
        'checkbox' => 'Checkbox',
        'choice' => 'Choice',
        'color' => 'Color',
        'country' => 'Country',
        'currency' => 'Currency',
        'dateInterval' => 'Date Interval',
        'dateTime' => 'Date and Time',
        'date' => 'Date',
        'email' => 'E-Mail',
        'file' => 'File',
        'group' => 'Group',
        'hidden' => 'Hidden',
        'integer' => 'Integer',
        'language' => 'Language',
        'money' => 'Money',
        'number' => 'Number',
        'password' => 'Password',
        'percent' => 'Percent',
        'radio' => 'Radio',
        'range' => 'Range',
        'reset' => 'Reset',
        'search' => 'Search',
        'submit' => 'Submit',
        'tel' => 'Telephone',
        'text' => 'Text',
        'textarea' => 'Textarea',
        'time' => 'Time',
        'timezone' => 'Timezone',
        'url' => 'Url',
        'week' => 'Week',
    ],
];
