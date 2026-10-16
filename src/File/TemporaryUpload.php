<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\File;

final readonly class TemporaryUpload
{
    public function __construct(
        public string $pathname,
        public string $name,
        public ?string $mimeType = null,
    ) {
    }
}
