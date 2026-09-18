<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Currencies;
use Symfony\Component\Intl\Languages;
use Symfony\Component\Intl\Timezones;

#[AsCallback(table: 'tl_oneup_form_field', target: 'fields.preferredChoices.options')]
class PreferredChoiceOptionListener
{
    public function __invoke(?DataContainer $dataContainer = null): array
    {
        $record = $dataContainer?->getCurrentRecord();

        return match ($record['type'] ?? null) {
            'country' => Countries::getNames(),
            'language' => Languages::getNames(),
            'currency' => Currencies::getNames(),
            'timezone' => Timezones::getNames(),
            default => [],
        };
    }
}
