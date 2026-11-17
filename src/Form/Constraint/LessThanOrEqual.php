<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Constraint;

use Oneup\ContaoFormBundle\Attribute\AsConstraint;
use Oneup\ContaoFormBundle\Form\AbstractComparisonConstraint;
use Oneup\ContaoFormBundle\Form\ConstraintGroup;
use Oneup\ContaoFormBundle\Form\ConstraintInterface;
use Symfony\Component\Validator\Constraints\LessThanOrEqual as LessThanOrEqualConstraint;

#[AsConstraint('lessThanOrEqual', LessThanOrEqualConstraint::class, group: ConstraintGroup::Comparison)]
class LessThanOrEqual extends AbstractComparisonConstraint implements ConstraintInterface
{
}
