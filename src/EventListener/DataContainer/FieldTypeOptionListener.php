<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;

#[AsCallback(table: 'tl_oneup_form_field', target: 'fields.type.options')]
class FieldTypeOptionListener
{
    public function __invoke(): array
    {
        return [
            'texts' => [
                'email',
                'search',
                'text',
                'textarea',
                'tel',
                'url',
            ],
            'buttons' => [
                'button',
                'reset',
                'submit',
            ],
            'choices' => [
                'checkbox',
                'choice',
                'country',
                'language',
                'radio',
            ],
            'dates' => [
                'birthday',
                'dateInterval',
                'dateTime',
                'date',
                'timezone',
                'time',
                'week',
            ],
            'moneys' => [
                'currency',
                'money',
            ],
            'numbers' => [
                'integer',
                'number',
                'percent',
            ],
            'others' => [
                'color',
                'file',
                'group',
                'hidden',
                'password',
                'range',
            ],
        ];
    }
}
