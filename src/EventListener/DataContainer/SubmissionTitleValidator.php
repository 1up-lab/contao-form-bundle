<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\CoreBundle\String\SimpleTokenParser;
use Symfony\Contracts\Translation\TranslatorInterface;

#[AsCallback(table: 'tl_oneup_form', target: 'fields.submissionTitle.save')]
class SubmissionTitleValidator
{
    public function __construct(
        private readonly SimpleTokenParser $tokenParser,
        private readonly TranslatorInterface $translator,
    ) {
    }

    public function __invoke(string $value): string
    {
        try {
            $this->tokenParser->parse($value, []);
        } catch (\RuntimeException|\InvalidArgumentException $exception) {
            throw new \RuntimeException($this->translator->trans('ERR.invalidSubmissionTitle', [$exception->getMessage()], 'contao_default'), 0, $exception);
        }

        return $value;
    }
}
