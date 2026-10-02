<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form;

use Oneup\ContaoFormBundle\Model\ConstraintModel;
use Symfony\Component\Validator\Constraint;

interface ConstraintInterface
{
    /**
     * @return class-string<Constraint>
     */
    public function getConstraintType(): string;

    public function resolveOptions(ConstraintModel $model): array;
}
