<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Constraint;

use Oneup\ContaoFormBundle\Attribute\AsConstraint;
use Oneup\ContaoFormBundle\Form\AbstractConstraint;
use Oneup\ContaoFormBundle\Form\ConstraintInterface;
use Symfony\Component\Validator\Constraints\NotBlank as NotBlankConstraint;

#[AsConstraint('notBlank', NotBlankConstraint::class)]
class NotBlank extends AbstractConstraint implements ConstraintInterface
{
}
