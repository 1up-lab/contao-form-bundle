<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Constraint;

use Contao\StringUtil;
use Oneup\ContaoFormBundle\Attribute\AsConstraint;
use Oneup\ContaoFormBundle\Form\AbstractConstraint;
use Oneup\ContaoFormBundle\Form\ConstraintGroup;
use Oneup\ContaoFormBundle\Form\ConstraintInterface;
use Oneup\ContaoFormBundle\Model\ConstraintModel;
use Symfony\Component\Validator\Constraints\Url as UrlConstraint;

#[AsConstraint('url', UrlConstraint::class, group: ConstraintGroup::String)]
class Url extends AbstractConstraint implements ConstraintInterface
{
    protected array $messageOptions = ['message', 'tldMessage'];

    public function resolveOptions(ConstraintModel $model): array
    {
        $options = [
            ...parent::resolveOptions($model),
            'requireTld' => (bool) $model->requireTopLevelDomain,
        ];

        $protocols = (array) StringUtil::deserialize($model->protocols, true);

        if ($protocols) {
            $options['protocols'] = array_values($protocols);
        }

        return $options;
    }
}
