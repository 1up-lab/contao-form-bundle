<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Symfony\Contracts\Translation\TranslatorInterface;

#[AsCallback(table: 'tl_oneup_form_constraint', target: 'fields.pattern.save')]
class RegexPatternValidator
{
    public function __construct(
        private readonly TranslatorInterface $translator,
    ) {
    }

    public function __invoke(string $value): string
    {
        if ('' === $value) {
            return $value;
        }

        $result = @preg_match($value, '');

        if (false === $result) {
            throw new \RuntimeException($this->translator->trans('ERR.invalidRegexPattern', [], 'contao_default'));
        }

        return $value;
    }
}
