<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form;

use Oneup\ContaoFormBundle\Model\ConstraintModel;

interface ConstraintInterface
{
    /**
     * @return class-string
     */
    public function getConstraintType(): string;

    public function resolveOptions(ConstraintModel $model): array;
}
