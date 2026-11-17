<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Constraint;

use Oneup\ContaoFormBundle\Attribute\AsConstraint;
use Oneup\ContaoFormBundle\Form\AbstractComparisonConstraint;
use Oneup\ContaoFormBundle\Form\ConstraintGroup;
use Oneup\ContaoFormBundle\Form\ConstraintInterface;
use Symfony\Component\Validator\Constraints\LessThan as LessThanConstraint;

#[AsConstraint('lessThan', LessThanConstraint::class, group: ConstraintGroup::Comparison)]
class LessThan extends AbstractComparisonConstraint implements ConstraintInterface
{
}
