<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Constraint;

use Oneup\ContaoFormBundle\Attribute\AsConstraint;
use Oneup\ContaoFormBundle\Form\AbstractComparisonConstraint;
use Oneup\ContaoFormBundle\Form\ConstraintInterface;
use Symfony\Component\Validator\Constraints\GreaterThan as GreaterThanConstraint;

#[AsConstraint('greaterThan', GreaterThanConstraint::class)]
class GreaterThan extends AbstractComparisonConstraint implements ConstraintInterface
{
}
