<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Constraint;

use Oneup\ContaoFormBundle\Attribute\AsConstraint;
use Oneup\ContaoFormBundle\Form\AbstractConstraint;
use Oneup\ContaoFormBundle\Form\ConstraintInterface;
use Symfony\Component\Validator\Constraints\PasswordStrength as PasswordStrengthConstraint;

#[AsConstraint('passwordStrength', PasswordStrengthConstraint::class)]
class PasswordStrength extends AbstractConstraint implements ConstraintInterface
{
}
