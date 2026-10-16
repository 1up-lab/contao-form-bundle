<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;
use Doctrine\DBAL\Connection;
use Oneup\ContaoFormBundle\Form\FieldGroup;
use Oneup\ContaoFormBundle\Form\Registry\FieldRegistry;

#[AsCallback(table: 'tl_oneup_form_field', target: 'fields.type.options')]
class FieldTypeOptionListener
{
    public function __construct(
        private readonly Connection $database,
        private readonly FieldRegistry $fieldRegistry,
    ) {
    }

    public function __invoke(?DataContainer $dc = null): array
    {
        $groups = array_map(static fn (FieldGroup $group): string => $group->value, FieldGroup::cases());
        $options = array_fill_keys($groups, []);
        $fields = $this->fieldRegistry->all();

        foreach ($fields as $name => $field) {
            $options[$field->getGroup()][] = $name;
        }

        $options = array_map(static function (array $names): array {
            sort($names);

            return $names;
        }, $options);

        if ($this->isMultistepRoot($dc)) {
            return $options[FieldGroup::Steps->value];
        }

        unset($options[FieldGroup::Steps->value]);

        return array_filter($options);
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
