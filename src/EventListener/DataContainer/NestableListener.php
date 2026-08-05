<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener\DataContainer;

use Contao\CoreBundle\DataContainer\DataContainerOperation;
use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Oneup\ContaoFormBundle\Form\FormRegistry;

#[AsCallback(table: 'tl_oneup_form_field', target: 'list.operations.children.button')]
class NestableListener
{
    public function __construct(
        private readonly FormRegistry $registry,
    ) {
    }

    public function __invoke(DataContainerOperation $operation): void
    {
        try {
            $formType = $this->registry->get($operation->getRecord()['type'] ?? '');
        } catch (\InvalidArgumentException) {
            return;
        }

        if ($formType->isNestable()) {
            return;
        }

        $operation->disable();
    }
}
