<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Service;

use Oneup\ContaoFormBundle\ExpressionLanguage\RecordNameLanguage;
use Symfony\Component\ExpressionLanguage\SyntaxError;

class SubmissionNameGenerator
{
    public function __construct(
        private readonly RecordNameLanguage $expressionLanguage,
    ) {
    }

    public function generate(string $expression, array $data): string
    {
        try {
            return $this->cast($this->expressionLanguage->evaluate($expression, ...$data));
        } catch (\RuntimeException|SyntaxError) {
            return '';
        }
    }

    private function cast(mixed $value): string
    {
        return match (true) {
            is_scalar($value), $value === null, $value instanceof \Stringable => (string) $value,

            default => '',
        };
    }
}
