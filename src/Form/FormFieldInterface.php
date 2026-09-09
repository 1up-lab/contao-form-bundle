<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form;

use Oneup\ContaoFormBundle\Model\FieldModel;
use Symfony\Component\Form\FormTypeInterface;

interface FormFieldInterface
{
    /**
     * @return class-string<FormTypeInterface>
     */
    public function getFormType(): string;

    public function resolveOptions(FieldModel $model): array;

    public function isConstrainable(): bool;

    public function isNestable(): bool;
}
