<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form;

class ConstraintMap
{
    private const array TEXT = [
        'notBlank',
        'blank',
        ConstraintGroup::String,
        ConstraintGroup::Date,
        ConstraintGroup::Choice,
    ];

    private const array NUMBER = [
        'notBlank',
        ConstraintGroup::Comparison,
        ConstraintGroup::Number,
    ];

    private const array DATE = [
        'notBlank',
        ConstraintGroup::Comparison,
    ];

    private const array REQUIRED = [
        'notBlank',
    ];

    private const FIELDS = [
        'text' => self::TEXT,
        'textarea' => self::TEXT,
        'search' => self::TEXT,
        'tel' => self::TEXT,
        'email' => ['notBlank', 'length', 'regex', 'email'],
        'url' => ['notBlank', 'length', 'regex', 'url'],
        'password' => ['notBlank', 'length', 'regex', 'passwordStrength'],
        'color' => ['notBlank', 'cssColor'],
        'number' => self::NUMBER,
        'integer' => self::NUMBER,
        'percent' => self::NUMBER,
        'money' => self::NUMBER,
        'range' => self::NUMBER,
        'date' => self::DATE,
        'dateTime' => self::DATE,
        'birthday' => self::DATE,
        'time' => self::REQUIRED,
        'week' => self::REQUIRED,
        'dateInterval' => self::REQUIRED,
        'timezone' => self::REQUIRED,
        'choice' => self::REQUIRED,
        'country' => self::REQUIRED,
        'language' => self::REQUIRED,
        'currency' => self::REQUIRED,
        'checkbox' => ['isTrue'],
        'file' => ['notBlank', ConstraintGroup::File],
    ];

    public function supports(string $fieldType, ConstraintInterface $constraint): bool
    {
        $allowed = self::FIELDS[$fieldType] ?? null;

        if (null === $allowed) {
            return true;
        }

        return \in_array($constraint->getName(), $allowed, true)
            || \in_array(ConstraintGroup::tryFrom($constraint->getGroup()), $allowed, true);
    }
}
