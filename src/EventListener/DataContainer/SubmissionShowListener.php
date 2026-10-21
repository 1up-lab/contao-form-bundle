<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\StringUtil;

#[AsCallback(table: 'tl_oneup_form_submission', target: 'config.onshow')]
class SubmissionShowListener
{
    public function __invoke(array $data, array $row): array
    {
        $values = json_decode((string) ($row['data'] ?? ''), true, 512, \JSON_THROW_ON_ERROR);

        if (!\is_array($values)) {
            return $data;
        }

        $rows = $data['tl_oneup_form_submission'][0] ?? [];

        $data['tl_oneup_form_submission'][0] = [...$rows, ...$this->getRows($values)];

        return $data;
    }

    private function getRows(array $values): array
    {
        $rows = [];

        foreach ($values as $value) {
            $label = StringUtil::specialchars((string) ($value['label'] ?? ''));
            $name = StringUtil::specialchars((string) ($value['name'] ?? ''));

            if (isset($value['children'])) {
                $rows['<strong>' . $label . '</strong> <small>' . $name . '</small>'] = '';
                $rows = [...$rows, ...$this->getRows($value['children'])];

                continue;
            }

            $rows[$label . ' <small>' . $name . '</small>'] = (string) ($value['text'] ?? '') ?: '–';
        }

        return $rows;
    }
}
