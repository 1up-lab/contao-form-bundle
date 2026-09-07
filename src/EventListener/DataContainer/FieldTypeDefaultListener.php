<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;

#[AsCallback(table: 'tl_oneup_form_field', target: 'config.onload')]
class FieldTypeDefaultListener
{
    public function __construct(
        private readonly FieldTypeOptionListener $fieldTypeOptionListener,
    ) {
    }

    public function __invoke(?DataContainer $dc = null): void
    {
        $allowedTypes = [];

        foreach (($this->fieldTypeOptionListener)($dc) as $options) {
            $allowedTypes = [...$allowedTypes, ...(array) $options];
        }

        $defaultType = $GLOBALS['TL_DCA']['tl_oneup_form_field']['fields']['type']['sql']['default'] ?? null;

        if (!\in_array($defaultType, $allowedTypes, true)) {
            $GLOBALS['TL_DCA']['tl_oneup_form_field']['fields']['type']['default'] = $allowedTypes[0] ?? '';
        }
    }
}
