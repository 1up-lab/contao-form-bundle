<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form;

interface FormFieldInterface
{
    public function getFormType(): string;

    public function resolveOptions(array $row): array;

    public function isConstrainable(): bool;

    public function isNestable(): bool;
}
