<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Oneup\ContaoFormBundle\Model\FormModel;
use Oneup\ContaoFormBundle\Service\SubmissionTitle;

#[AsCallback(table: 'tl_oneup_form_submission', target: 'list.label.label')]
class SubmissionLabelListener
{
    public function __construct(
        private readonly SubmissionTitle $submissionTitle,
    ) {
    }

    public function __invoke(array $row, string $label): string
    {
        $values = json_decode((string) ($row['data'] ?? ''), true);
        $formModel = FormModel::findById((int) $row['pid']);

        if (!\is_array($values) || null === $formModel) {
            return $label;
        }

        return $label . ' ' . $this->submissionTitle->generate((string) $formModel->submissionTitle, $values);
    }
}
