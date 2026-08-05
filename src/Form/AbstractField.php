<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form;

class AbstractField
{
    protected string $name;
    protected string $formType;
    protected bool $constrainable;
    protected bool $nestable;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFormType(): string
    {
        return $this->formType;
    }

    public function setFormType(string $formType): self
    {
        $this->formType = $formType;

        return $this;
    }

    public function isConstrainable(): bool
    {
        return $this->constrainable;
    }

    public function setConstrainable(bool $constrainable): self
    {
        $this->constrainable = $constrainable;

        return $this;
    }

    public function isNestable(): bool
    {
        return $this->nestable;
    }

    public function setNestable(bool $nestable): self
    {
        $this->nestable = $nestable;

        return $this;
    }

    public function resolveOptions(array $row): array
    {
        return [];
    }
}
