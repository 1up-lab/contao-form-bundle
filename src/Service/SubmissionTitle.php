<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Service;

use Contao\CoreBundle\String\SimpleTokenParser;
use Contao\StringUtil;

class SubmissionTitle
{
    public function __construct(
        private readonly SimpleTokenParser $tokenParser,
    ) {
    }

    public function generate(string $title, array $values): string
    {
        $tokens = $this->flatten($values);

        try {
            $title = $this->tokenParser->parse($title, $tokens);
        } catch (\RuntimeException|\InvalidArgumentException) {
            return '';
        }

        $title = (string) preg_replace('/##[^=!<>\s]+?##/', '', $title);

        return StringUtil::specialchars(trim($title));
    }

    private function flatten(array $values): array
    {
        $fields = [];

        foreach ($values as $value) {
            if (isset($value['children'])) {
                $fields = [...$fields, ...$this->flatten($value['children'])];

                continue;
            }

            $fields[$value['name']] = $value['text'];
        }

        return $fields;
    }
}
