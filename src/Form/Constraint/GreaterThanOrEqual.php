<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Constraint;

use Oneup\ContaoFormBundle\Attribute\AsConstraint;
use Oneup\ContaoFormBundle\Form\AbstractComparisonConstraint;
use Oneup\ContaoFormBundle\Form\ConstraintGroup;
use Oneup\ContaoFormBundle\Form\ConstraintInterface;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual as GreaterThanOrEqualConstraint;

#[AsConstraint('greaterThanOrEqual', GreaterThanOrEqualConstraint::class, group: ConstraintGroup::Comparison)]
class GreaterThanOrEqual extends AbstractComparisonConstraint implements ConstraintInterface
{
}
