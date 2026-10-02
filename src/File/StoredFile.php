<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\File;

final readonly class StoredFile
{
    public function __construct(
        public string $name,
        public string $pathname,
        public ?string $path = null,
        public ?string $link = null,
        public bool $attachToEmail = false,
    ) {
    }
}
