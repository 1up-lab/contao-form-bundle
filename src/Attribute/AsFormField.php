<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Attribute;

#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::IS_REPEATABLE)]
class AsFormField
{
    public function __construct(
        public string $name,
        public string $formType,
        public bool $constrainable = true,
        public bool $nestable = false,
    ) {
    }
}
