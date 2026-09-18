<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Constraint;

use Oneup\ContaoFormBundle\Attribute\AsConstraint;
use Oneup\ContaoFormBundle\Form\AbstractConstraint;
use Oneup\ContaoFormBundle\Form\ConstraintInterface;
use Symfony\Component\Validator\Constraints\Positive as PositiveConstraint;

#[AsConstraint('positive', PositiveConstraint::class)]
class Positive extends AbstractConstraint implements ConstraintInterface
{
}
