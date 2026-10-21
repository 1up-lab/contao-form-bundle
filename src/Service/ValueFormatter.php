<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Service;

use Oneup\ContaoFormBundle\File\StoredFiles;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ValueFormatter
{
    public function format(mixed $value, StoredFiles $storedFiles): string
    {
        return match (true) {
            $value instanceof UploadedFile => $storedFiles->get($value)->path ?? $value->getClientOriginalName(),
            $value instanceof \DateTimeInterface => $value->format('Y-m-d H:i'),
            \is_bool($value) => $value ? '1' : '',
            \is_array($value) => $this->formatList($value, $storedFiles),
            \is_object($value) => '',
            default => (string) $value,
        };
    }

    private function formatList(array $values, StoredFiles $storedFiles): string
    {
        $texts = array_map(fn (mixed $value): string => $this->format($value, $storedFiles), $values);

        return implode(', ', array_filter($texts, static fn (string $text): bool => '' !== $text));
    }
}
