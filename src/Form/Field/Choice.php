<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Field;

use Contao\StringUtil;
use Oneup\ContaoFormBundle\Attribute\AsField;
use Oneup\ContaoFormBundle\Form\AbstractField;
use Oneup\ContaoFormBundle\Form\FieldInterface;
use Oneup\ContaoFormBundle\Model\FieldModel;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

#[AsField(name: 'choice', formType: ChoiceType::class)]
class Choice extends AbstractField implements FieldInterface
{
    public function resolveOptions(FieldModel $model): array
    {
        $options = parent::resolveOptions($model);

        if ($model->placeholder) {
            $options['placeholder'] = $model->placeholder;
        }

        $options['expanded'] = $model->expanded;
        $options['multiple'] = $model->multiple;

        $selectableOptions = $this->getSelectableOptions($model);
        $groups = array_column($selectableOptions, 'group', 'value');

        $options['choices'] = array_column($selectableOptions, 'value', 'label');
        $options['group_by'] = static fn (string $choice): ?string => $groups[$choice] ?? null;

        return $options;
    }

    public function resolveData(FieldModel $model): mixed
    {
        $rows = array_filter($this->getSelectableOptions($model), static fn (array $row): bool => $row['default']);
        $defaults = array_column($rows, 'value');

        if (!$defaults) {
            return null;
        }

        return $model->multiple ? $defaults : $defaults[0];
    }

    private function getSelectableOptions(FieldModel $model): array
    {
        $rows = [];
        $group = null;
        $options = (array) StringUtil::deserialize($model->options, true);

        foreach ($options as $option) {
            if (!\is_array($option) || !\is_string($option['label'] ?? null)) {
                continue;
            }

            $label = trim($option['label']);

            if ('' === $label) {
                continue;
            }

            if ($option['group'] ?? false) {
                $group = $label;

                continue;
            }

            $value = \is_string($option['value'] ?? null) ? trim($option['value']) : '';

            $rows[] = [
                'label' => $label,
                'value' => '' !== $value ? $value : $label,
                'default' => (bool) ($option['default'] ?? false),
                'group' => $group,
            ];
        }

        return $rows;
    }
}
