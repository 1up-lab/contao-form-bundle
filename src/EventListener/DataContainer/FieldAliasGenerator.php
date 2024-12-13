<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\CoreBundle\Slug\Slug;
use Contao\DataContainer;
use Doctrine\DBAL\Connection;

#[AsCallback(table: 'tl_oneup_form_field', target: 'config.onsubmit')]
class FieldAliasGenerator
{
    public function __construct(
        private readonly Slug $slugGenerator,
        private readonly Connection $database,
    ) {
    }

    public function __invoke(?DataContainer $dc): void
    {
        if (null === $dc) {
            return;
        }

        $record = $dc->getCurrentRecord();

        if (null === $record) {
            return;
        }

        if ($record['alias'] ?? false) {
            return;
        }

        $formId = (int) $record['pid'];

        $alias = $this->slugGenerator->generate((string) $record['name'], options: ['validChars' => '0-9a-z'], duplicateCheck: function (string $slug) use ($formId): bool {
            $res = $this->database->createQueryBuilder()
                ->select('COUNT(1)')
                ->from('tl_oneup_form_field', 'f')
                ->andWhere('f.pid = :pid')
                ->andWhere('f.alias = :slug')

                ->setParameter('slug', $slug)
                ->setParameter('pid', $formId)

                ->fetchOne()
            ;

            return $res > 0;
        });

        $this->database->update('tl_oneup_form_field', ['alias' => $alias], ['id' => $dc->id]);
    }
}
