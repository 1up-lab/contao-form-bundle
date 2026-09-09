<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form;

use Oneup\ContaoFormBundle\Model\ConstraintModel;

abstract class AbstractConstraint
{
    protected string $name;
    protected string $constraintType;

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
        if ($model->message) {
            return [
                'message' => $model->message,
            ];
        }

        return [];
    }
}
