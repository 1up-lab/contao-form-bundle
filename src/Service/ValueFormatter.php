<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Service;

use Oneup\ContaoFormBundle\File\StoredFiles;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Contracts\Translation\TranslatorInterface;

class ValueFormatter
{
    public function __construct(
        private readonly TranslatorInterface $translator,
    ) {
    }

    public function format(mixed $value, StoredFiles $storedFiles): string
    {
        return match (true) {
            $value instanceof UploadedFile => $storedFiles->get($value)->path ?? $value->getClientOriginalName(),
            $value instanceof \DateTimeInterface => $value->format('Y-m-d H:i'),
            $value instanceof \DateInterval => $this->formatInterval($value),
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

    private function formatInterval(\DateInterval $interval): string
    {
        $units = [
            'years' => $interval->y,
            'months' => $interval->m,
            'days' => $interval->d,
            'hours' => $interval->h,
            'minutes' => $interval->i,
            'seconds' => $interval->s,
        ];

        $usedUnits = array_filter($units);
        $parts = [];

        foreach ($usedUnits as $unit => $count) {
            $parts[] = $this->translator->trans('interval.' . $unit, ['%count%' => $count], 'oneup_form_bundle');
        }

        if (!$parts) {
            return '';
        }

        $text = implode(', ', $parts);

        return $interval->invert ? '-' . $text : $text;
    }
}
