<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\NotificationCenter;

class SubmissionTokens
{
    public function create(array $values, array $formConfig, array $vouchers = []): array
    {
        $fields = $this->getFields($values);

        return [
            ...$this->getFormConfigTokens($formConfig),
            ...$this->getFieldTokens($fields, $vouchers),
            ...$this->getSummaryTokens($fields),
        ];
    }

    private function getFields(array $values): array
    {
        $fields = [];

        foreach ($values as $value) {
            if (isset($value['children'])) {
                $fields = [...$fields, ...$this->getFields($value['children'])];
            } else {
                $fields[] = $value;
            }
        }

        return $fields;
    }

    private function getFormConfigTokens(array $formConfig): array
    {
        $tokens = [];

        foreach ($formConfig as $key => $value) {
            if (\is_string($value) || \is_int($value)) {
                $tokens['formconfig_' . $key] = $value;
            }
        }

        return $tokens;
    }

    private function getFieldTokens(array $fields, array $vouchers): array
    {
        $tokens = [];

        foreach ($fields as $field) {
            $name = $field['name'];

            $tokens['formlabel_' . $name] = $field['label'];
            $tokens['form_' . $name] = $field['text'];

            if (isset($vouchers[$name])) {
                $tokens['form_' . $name] = implode(',', $vouchers[$name]);
                $tokens['file_' . $name] = $field['text'];
            }
        }

        return $tokens;
    }

    private function getSummaryTokens(array $fields): array
    {
        $filledFields = array_filter($fields, static fn (array $field): bool => '' !== $field['text']);

        $lines = $this->getLines($fields);
        $filledLines = $this->getLines($filledFields);

        return [
            'raw_data' => implode("\n", $lines),
            'raw_data_filled' => implode("\n", $filledLines),
            'html_data' => $this->toHtml($lines),
            'html_data_filled' => $this->toHtml($filledLines),
        ];
    }

    private function getLines(array $fields): array
    {
        return array_map(static fn (array $field): string => $field['label'] . ': ' . $field['text'], $fields);
    }

    private function toHtml(array $lines): string
    {
        $escaped = array_map(static fn (string $line): string => htmlspecialchars($line, \ENT_QUOTES), $lines);

        return implode('<br>', $escaped);
    }
}
