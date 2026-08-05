<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form;

class AbstractConstraint
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

    public function resolveOptions(array $options): array
    {
        if ($options['message'] ?? null) {
            return [
                'message' => $options['message'],
            ];
        }

        return [];
    }
}
