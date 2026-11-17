<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Attribute;

use Oneup\ContaoFormBundle\Form\ConstraintGroup;

#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::IS_REPEATABLE)]
class AsConstraint
{
    public function __construct(
        public string $name,
        public string $constraintType,
        public ConstraintGroup|string $group = ConstraintGroup::Basic,
    ) {
    }
}
