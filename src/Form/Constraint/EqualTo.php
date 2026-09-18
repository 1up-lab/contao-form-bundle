<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Constraint;

use Oneup\ContaoFormBundle\Attribute\AsConstraint;
use Oneup\ContaoFormBundle\Form\AbstractComparisonConstraint;
use Oneup\ContaoFormBundle\Form\ConstraintInterface;
use Symfony\Component\Validator\Constraints\EqualTo as EqualToConstraint;

#[AsConstraint('equalTo', EqualToConstraint::class)]
class EqualTo extends AbstractComparisonConstraint implements ConstraintInterface
{
}
