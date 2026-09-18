<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Constraint;

use Oneup\ContaoFormBundle\Attribute\AsConstraint;
use Oneup\ContaoFormBundle\Form\AbstractConstraint;
use Oneup\ContaoFormBundle\Form\ConstraintInterface;
use Oneup\ContaoFormBundle\Model\ConstraintModel;
use Symfony\Component\Validator\Constraints\Range as RangeConstraint;

#[AsConstraint('range', RangeConstraint::class)]
class Range extends AbstractConstraint implements ConstraintInterface
{
    public function resolveOptions(ConstraintModel $model): array
    {
        $options = [];

        if ($model->min) {
            $options['min'] = (int) $model->min;
        }

        if ($model->max) {
            $options['max'] = (int) $model->max;
        }

        if ($model->overwriteMessage && $model->message) {
            $messageOption = match (true) {
                isset($options['min'], $options['max']) => 'notInRangeMessage',
                isset($options['min']) => 'minMessage',
                default => 'maxMessage',
            };

            return [$messageOption => $model->message, ...$options];
        }

        return $options;
    }
}
