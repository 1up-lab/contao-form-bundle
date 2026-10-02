<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form;

use Oneup\ContaoFormBundle\Model\FieldModel;
use Symfony\Component\Form\FormTypeInterface;

interface FieldInterface
{
    /**
     * @return class-string<FormTypeInterface>
     */
    public function getFormType(): string;

    public function resolveOptions(FieldModel $model): array;

    public function resolveData(FieldModel $model): mixed;

    public function resolveConstraints(FieldModel $model, array $constraints): array;

    public function isConstrainable(): bool;

    public function isNestable(): bool;
}
