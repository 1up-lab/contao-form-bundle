<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener\DataContainer;

use Contao\CoreBundle\DataContainer\DataContainerOperation;
use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;

#[AsCallback(table: 'tl_oneup_form', target: 'list.operations.submissions.button')]
class SubmissionButtonListener
{
    public function __invoke(DataContainerOperation $operation): void
    {
        if ($operation->getRecord()['storeSubmissions'] ?? false) {
            return;
        }

        $operation->hide();
    }
}
