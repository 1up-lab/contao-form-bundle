<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;
use Doctrine\DBAL\Connection;
use Oneup\ContaoFormBundle\Form\ConstraintGroup;
use Oneup\ContaoFormBundle\Form\ConstraintMap;
use Oneup\ContaoFormBundle\Form\Registry\ConstraintRegistry;

#[AsCallback(table: 'tl_oneup_form_constraint', target: 'fields.type.options')]
class ConstraintTypeOptionListener
{
    public function __construct(
        private readonly Connection $database,
        private readonly ConstraintRegistry $constraintRegistry,
        private readonly ConstraintMap $constraintMap,
    ) {
    }

    public function __invoke(?DataContainer $dc = null): array
    {
        $groups = array_map(static fn (ConstraintGroup $group): string => $group->value, ConstraintGroup::cases());
        $options = array_fill_keys($groups, []);

        $fieldType = $this->getFieldType($dc);
        $currentType = $dc?->getCurrentRecord()['type'] ?? null;
        $constraints = $this->constraintRegistry->all();

        foreach ($constraints as $name => $constraint) {
            if ($name === $currentType || $this->constraintMap->supports($fieldType, $constraint)) {
                $options[$constraint->getGroup()][] = $name;
            }
        }

        $options = array_map(static function (array $names): array {
            sort($names);

            return $names;
        }, $options);

        return array_filter($options);
    }

    private function getFieldType(?DataContainer $dc): string
    {
        $fieldId = (int) $dc?->currentPid;

        if (!$fieldId) {
            return '';
        }

        $type = $this->database->fetchOne('SELECT type FROM tl_oneup_form_field WHERE id = ?', [$fieldId]);

        return \is_string($type) ? $type : '';
    }
}
