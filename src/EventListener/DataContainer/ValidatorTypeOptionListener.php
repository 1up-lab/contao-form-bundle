<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
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

#[AsCallback(table: 'tl_oneup_form_validator', target: 'fields.type.options')]
class ValidatorTypeOptionListener
{
    public function __invoke(): array
    {
        return [
            'basic' => [
                NotBlank::class,
            ],
            'string' => [
                Regex::class,
            ],
            'comparison' => [
                DivisibleBy::class,
                EqualTo::class,
                GreaterThan::class,
                GreaterThanOrEqual::class,
                LessThan::class,
                LessThanOrEqual::class,
                NotEqualTo::class,
                Range::class,
            ],
            'number' => [
                Negative::class,
                NegativeOrZero::class,
                Positive::class,
                PositiveOrZero::class,
            ],
        ];
    }
}
