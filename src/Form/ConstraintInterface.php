<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form;

interface ConstraintInterface
{
    /**
     * @return class-string
     */
    public function getConstraintType(): string;

    public function resolveOptions(array $row): array;
}
