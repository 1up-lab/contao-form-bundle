<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Constraint;

use Oneup\ContaoFormBundle\Attribute\AsConstraint;
use Oneup\ContaoFormBundle\Form\AbstractComparisonConstraint;
use Oneup\ContaoFormBundle\Form\ConstraintInterface;
use Symfony\Component\Validator\Constraints\NotEqualTo as NotEqualToConstraint;

#[AsConstraint('notEqualTo', NotEqualToConstraint::class)]
class NotEqualTo extends AbstractComparisonConstraint implements ConstraintInterface
{
}
