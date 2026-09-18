<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Constraint;

use Oneup\ContaoFormBundle\Attribute\AsConstraint;
use Oneup\ContaoFormBundle\Form\AbstractComparisonConstraint;
use Oneup\ContaoFormBundle\Form\ConstraintInterface;
use Symfony\Component\Validator\Constraints\DivisibleBy as DivisibleByConstraint;

#[AsConstraint('divisibleBy', DivisibleByConstraint::class)]
class DivisibleBy extends AbstractComparisonConstraint implements ConstraintInterface
{
}
