<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Constraint;

use Oneup\ContaoFormBundle\Attribute\AsConstraint;
use Oneup\ContaoFormBundle\Form\AbstractConstraint;
use Oneup\ContaoFormBundle\Form\ConstraintInterface;
use Symfony\Component\Validator\Constraints\PositiveOrZero as PositiveOrZeroConstraint;

#[AsConstraint('positiveOrZero', PositiveOrZeroConstraint::class)]
class PositiveOrZero extends AbstractConstraint implements ConstraintInterface
{
}
