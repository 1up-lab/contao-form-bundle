<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form;

use Oneup\ContaoFormBundle\Model\ConstraintModel;

abstract class AbstractConstraint
{
    protected string $name;
    protected string $constraintType;
    protected array $messageOptions = ['message'];

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getConstraintType(): string
    {
        return $this->constraintType;
    }

    public function setConstraintType(string $constraintType): self
    {
        $this->constraintType = $constraintType;

        return $this;
    }

    public function resolveOptions(ConstraintModel $model): array
    {
        if ($model->overwriteMessage && $model->message) {
            return array_fill_keys($this->messageOptions, $model->message);
        }

        return [];
    }
}
