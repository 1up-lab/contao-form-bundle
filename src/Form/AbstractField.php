<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form;

use Oneup\ContaoFormBundle\Model\FieldModel;

abstract class AbstractField
{
    protected string $name;
    protected string $formType;
    protected bool $constrainable;
    protected bool $nestable;
    protected string $group = 'others';

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

    public function getGroup(): string
    {
        return $this->group;
    }

    public function setGroup(string $group): self
    {
        $this->group = $group;

        return $this;
    }

    public function resolveOptions(FieldModel $model): array
    {
        return [
            'required' => $model->required,
            'label' => $model->label ?: $model->name,
            'label_html' => $model->labelHtml,
            'help' => $model->help,
            'help_html' => $model->helpHtml,
        ];
    }

    public function resolveData(FieldModel $model): mixed
    {
        return null;
    }

    public function resolveConstraints(FieldModel $model, array $constraints): array
    {
        return $constraints;
    }
}
