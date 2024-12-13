<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Doctrine\DBAL\Connection;

#[AsCallback(table: 'tl_content', target: 'fields.oneup_form.options')]
class FormListProvider
{
    public function __construct(
        private readonly Connection $database,
    ) {
    }

    public function __invoke(): array
    {
        return $this->database->createQueryBuilder()
            ->select('f.id', 'f.name')
            ->from('tl_oneup_form', 'f')
            ->orderBy('f.name')

            ->fetchAllKeyValue()
        ;
    }
}
