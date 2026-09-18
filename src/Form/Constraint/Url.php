<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Constraint;

use Oneup\ContaoFormBundle\Attribute\AsConstraint;
use Oneup\ContaoFormBundle\Form\AbstractConstraint;
use Oneup\ContaoFormBundle\Form\ConstraintInterface;
use Oneup\ContaoFormBundle\Model\ConstraintModel;
use Symfony\Component\Validator\Constraints\Url as UrlConstraint;

#[AsConstraint('url', UrlConstraint::class)]
class Url extends AbstractConstraint implements ConstraintInterface
{
    public function resolveOptions(ConstraintModel $model): array
    {
        return [
            ...parent::resolveOptions($model),
            'requireTld' => (bool) $model->requireTopLevelDomain,
        ];
    }
}
