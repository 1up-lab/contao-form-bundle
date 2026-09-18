<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;

#[AsCallback(table: 'tl_oneup_form_constraint', target: 'fields.type.options')]
class ConstraintTypeOptionListener
{
    public function __invoke(): array
    {
        return [
            'basic' => [
                'blank',
                'notBlank',
                'isTrue',
            ],
            'string' => [
                'regex',
                'cssColor',
                'email',
                'length',
                'noSuspiciousCharacters',
                'passwordStrength',
                'url',
                'wordCount',
            ],
            'comparison' => [
                'divisibleBy',
                'equalTo',
                'greaterThan',
                'greaterThanOrEqual',
                'lessThan',
                'lessThanOrEqual',
                'notEqualTo',
            ],
            'number' => [
                'range',
                'negative',
                'negativeOrZero',
                'positive',
                'positiveOrZero',
            ],
            'date' => [
                'date',
                'dateTime',
                'time',
            ],
            'choice' => [
                'country',
            ],
            'file' => [
                'file',
                'image',
            ],
        ];
    }
}
