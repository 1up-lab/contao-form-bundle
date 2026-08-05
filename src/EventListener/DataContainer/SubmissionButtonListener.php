<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener\DataContainer;

use Contao\CoreBundle\DataContainer\DataContainerOperation;
use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Oneup\ContaoFormBundle\Form\Registry\FormRegistry;

#[AsCallback(table: 'tl_oneup_form', target: 'list.operations.submissions.button')]
class SubmissionButtonListener
{
    public function __construct(
        private readonly FormRegistry $registry,
    ) {
    }

    public function __invoke(DataContainerOperation $operation): void
    {
        if ($operation->getRecord()['storeSubmissions'] ?? false) {
            return;
        }

        $operation->hide();
    }
}
