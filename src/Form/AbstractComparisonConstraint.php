<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form;

use Oneup\ContaoFormBundle\Model\ConstraintModel;

abstract class AbstractComparisonConstraint extends AbstractConstraint
{
    public function resolveOptions(ConstraintModel $model): array
    {
        return [
            ...parent::resolveOptions($model),
            'value' => $this->castValue($model->value),
        ];
    }

    private function castValue(string $value): float|int|string
    {
        return is_numeric($value) ? $value + 0 : $value;
    }
}
