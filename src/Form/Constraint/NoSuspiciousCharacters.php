<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Constraint;

use Oneup\ContaoFormBundle\Attribute\AsConstraint;
use Oneup\ContaoFormBundle\Form\AbstractConstraint;
use Oneup\ContaoFormBundle\Form\ConstraintInterface;
use Symfony\Component\Validator\Constraints\NoSuspiciousCharacters as NoSuspiciousCharactersConstraint;

#[AsConstraint('noSuspiciousCharacters', NoSuspiciousCharactersConstraint::class)]
class NoSuspiciousCharacters extends AbstractConstraint implements ConstraintInterface
{
    protected array $messageOptions = ['restrictionLevelMessage', 'invisibleMessage', 'mixedNumbersMessage', 'hiddenOverlayMessage'];
}
