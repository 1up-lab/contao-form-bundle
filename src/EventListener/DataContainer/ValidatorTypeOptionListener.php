<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;

#[AsCallback(table: 'tl_oneup_form_validator', target: 'fields.type.options')]
class ValidatorTypeOptionListener
{
    public function __invoke(): array
    {
        return [
            'basic' => [
                'notBlank',
            ],
            'string' => [
                'regex',
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
        ];
    }
}
