<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Constraint;

use Oneup\ContaoFormBundle\Attribute\AsConstraint;
use Oneup\ContaoFormBundle\Form\AbstractConstraint;
use Oneup\ContaoFormBundle\Form\ConstraintInterface;
use Oneup\ContaoFormBundle\Model\ConstraintModel;
use Symfony\Component\Validator\Constraints\Regex as RegexConstraint;

#[AsConstraint('regex', RegexConstraint::class)]
class Regex extends AbstractConstraint implements ConstraintInterface
{
    public function resolveOptions(ConstraintModel $model): array
    {
        return [
            ...parent::resolveOptions($model),
            'pattern' => $model->pattern,
            'match' => (bool) $model->matchPattern,
        ];
    }
}
