<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Constraint;

use Oneup\ContaoFormBundle\Attribute\AsConstraint;
use Oneup\ContaoFormBundle\Form\AbstractConstraint;
use Oneup\ContaoFormBundle\Form\ConstraintInterface;
use Symfony\Component\Validator\Constraints\IsTrue as IsTrueConstraint;

#[AsConstraint('isTrue', IsTrueConstraint::class)]
class IsTrue extends AbstractConstraint implements ConstraintInterface
{
}
