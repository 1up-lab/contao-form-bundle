<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Service;

use Contao\StringUtil;
use Oneup\ContaoFormBundle\ExpressionLanguage\SubmissionTitleLanguage;
use Oneup\ContaoFormBundle\File\StoredFiles;

class SubmissionTitle
{
    public function __construct(
        private readonly SubmissionTitleLanguage $expressionLanguage,
        private readonly ValueFormatter $valueFormatter,
    ) {
    }

    public function generate(string $expression, array $data, StoredFiles $storedFiles): string
    {
        if ('' === trim($expression)) {
            return '';
        }

        try {
            $title = $this->expressionLanguage->evaluate($expression, [
                'data' => new \ArrayObject($data, \ArrayObject::ARRAY_AS_PROPS),
            ]);
        } catch (\Throwable) {
            return '';
        }

        return StringUtil::specialchars(trim($this->valueFormatter->format($title, $storedFiles)));
    }
}
