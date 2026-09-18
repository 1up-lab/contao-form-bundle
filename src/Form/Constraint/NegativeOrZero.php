<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Constraint;

use Oneup\ContaoFormBundle\Attribute\AsConstraint;
use Oneup\ContaoFormBundle\Form\AbstractConstraint;
use Oneup\ContaoFormBundle\Form\ConstraintInterface;
use Symfony\Component\Validator\Constraints\NegativeOrZero as NegativeOrZeroConstraint;

#[AsConstraint('negativeOrZero', NegativeOrZeroConstraint::class)]
class NegativeOrZero extends AbstractConstraint implements ConstraintInterface
{
}
