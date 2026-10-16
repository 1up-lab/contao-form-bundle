<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Attribute;

use Oneup\ContaoFormBundle\Form\FieldGroup;

#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::IS_REPEATABLE)]
class AsField
{
    public function __construct(
        public string $name,
        public string $formType,
        public bool $constrainable = true,
        public bool $nestable = false,
        public FieldGroup|string $group = FieldGroup::Others,
    ) {
    }
}
