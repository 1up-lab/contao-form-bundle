<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Constraint;

use Oneup\ContaoFormBundle\Attribute\AsConstraint;
use Oneup\ContaoFormBundle\Form\AbstractConstraint;
use Oneup\ContaoFormBundle\Form\ConstraintGroup;
use Oneup\ContaoFormBundle\Form\ConstraintInterface;
use Symfony\Component\Validator\Constraints\Negative as NegativeConstraint;

#[AsConstraint('negative', NegativeConstraint::class, group: ConstraintGroup::Number)]
class Negative extends AbstractConstraint implements ConstraintInterface
{
}
