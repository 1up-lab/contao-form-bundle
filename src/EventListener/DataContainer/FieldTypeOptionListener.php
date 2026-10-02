<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;
use Doctrine\DBAL\Connection;

#[AsCallback(table: 'tl_oneup_form_field', target: 'fields.type.options')]
class FieldTypeOptionListener
{
    public function __construct(
        private readonly Connection $database,
    ) {
    }

    public function __invoke(?DataContainer $dc = null): array
    {
        if ($this->isMultistepRoot($dc)) {
            return ['step'];
        }

        return [
            'texts' => [
                'email',
                'search',
                'text',
                'textarea',
                'tel',
                'url',
            ],
            'buttons' => [
                'button',
                'reset',
                'submit',
            ],
            'choices' => [
                'checkbox',
                'choice',
                'country',
                'language',
                'radio',
            ],
            'dates' => [
                'birthday',
                'dateInterval',
                'dateTime',
                'date',
                'timezone',
                'time',
                'week',
            ],
            'moneys' => [
                'currency',
                'money',
            ],
            'numbers' => [
                'integer',
                'number',
                'percent',
            ],
            'others' => [
                'altcha',
                'color',
                'file',
                'group',
                'hidden',
                'password',
                'range',
            ],
        ];
    }

    private function isMultistepRoot(?DataContainer $dataContainer): bool
    {
        if (null === $dataContainer) {
            return false;
        }

        if ('tl_oneup_form' !== ($GLOBALS['TL_DCA']['tl_oneup_form_field']['config']['ptable'] ?? null)) {
            return false;
        }

        $formId = (int) $dataContainer->currentPid;

        if (!$formId) {
            return false;
        }

        return (bool) $this->database->fetchOne('SELECT isMultistep FROM tl_oneup_form WHERE id = ?', [$formId]);
    }
}
