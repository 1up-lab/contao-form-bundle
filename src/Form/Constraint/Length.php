<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Constraint;

use Oneup\ContaoFormBundle\Attribute\AsConstraint;
use Oneup\ContaoFormBundle\Form\AbstractConstraint;
use Oneup\ContaoFormBundle\Form\ConstraintInterface;
use Oneup\ContaoFormBundle\Model\ConstraintModel;
use Symfony\Component\Validator\Constraints\Length as LengthConstraint;

#[AsConstraint('length', LengthConstraint::class)]
class Length extends AbstractConstraint implements ConstraintInterface
{
    protected array $messageOptions = ['minMessage', 'maxMessage'];

    public function resolveOptions(ConstraintModel $model): array
    {
        $options = parent::resolveOptions($model);

        if (null !== $model->min) {
            $options['min'] = (int) $model->min;
        }

        if (null !== $model->max) {
            $options['max'] = (int) $model->max;
        }

        return $options;
    }
}
