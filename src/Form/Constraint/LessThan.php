<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Constraint;

use Oneup\ContaoFormBundle\Attribute\AsConstraint;
use Oneup\ContaoFormBundle\Form\AbstractComparisonConstraint;
use Oneup\ContaoFormBundle\Form\ConstraintInterface;
use Symfony\Component\Validator\Constraints\LessThan as LessThanConstraint;

#[AsConstraint('lessThan', LessThanConstraint::class)]
class LessThan extends AbstractComparisonConstraint implements ConstraintInterface
{
}
