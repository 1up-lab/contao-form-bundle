<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;

#[AsCallback(table: 'tl_oneup_form_field', target: 'config.onload')]
class HtmlAllowedInputTypeListener
{
    public function __invoke(?DataContainer $dc = null): void
    {
        if (null === $dc) {
            return;
        }

        $record = $dc->getCurrentRecord();

        if ($record['labelHtml'] ?? false) {
            $GLOBALS['TL_DCA']['tl_oneup_form_field']['fields']['label']['inputType'] = 'textarea';
            $GLOBALS['TL_DCA']['tl_oneup_form_field']['fields']['label']['eval']['rte'] = 'tinyMCE';
        }

        if ($record['helpHtml'] ?? false) {
            $GLOBALS['TL_DCA']['tl_oneup_form_field']['fields']['help']['inputType'] = 'textarea';
            $GLOBALS['TL_DCA']['tl_oneup_form_field']['fields']['help']['eval']['rte'] = 'tinyMCE';
        }
    }
}
