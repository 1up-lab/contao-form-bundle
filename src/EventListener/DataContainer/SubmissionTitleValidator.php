<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Oneup\ContaoFormBundle\ExpressionLanguage\SubmissionTitleLanguage;
use Symfony\Component\ExpressionLanguage\SyntaxError;
use Symfony\Contracts\Translation\TranslatorInterface;

#[AsCallback(table: 'tl_oneup_form', target: 'fields.submissionTitle.save')]
class SubmissionTitleValidator
{
    public function __construct(
        private readonly SubmissionTitleLanguage $expressionLanguage,
        private readonly TranslatorInterface $translator,
    ) {
    }

    public function __invoke(string $value): string
    {
        if ('' === trim($value)) {
            return $value;
        }

        try {
            $this->expressionLanguage->lint($value, ['data']);
        } catch (SyntaxError $exception) {
            throw new \RuntimeException($this->translator->trans('ERR.invalidSubmissionTitle', [$exception->getMessage()], 'contao_default'), 0, $exception);
        }

        return $value;
    }
}
