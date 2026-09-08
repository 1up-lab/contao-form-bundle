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

        $name = (string) $record['name'];

        if (!$name) {
            return;
        }

        if ($record['alias'] ?? false) {
            return;
        }

        $aliases = $this->getCompetingAliases($record);

        $alias = $this->slugGenerator->generate(
            $name,
            options: ['validChars' => '0-9a-z'],
            duplicateCheck: static fn (string $slug): bool => \in_array($slug, $aliases, true),
        );

        $this->database->update('tl_oneup_form_field', ['alias' => $alias], ['id' => $dc->id]);
    }

    private function getCompetingAliases(array $record): array
    {
        $formId = $this->getRootFormId($record);

        if (null !== $formId && $this->database->fetchOne('SELECT isMultistep FROM tl_oneup_form WHERE id = ?', [$formId])) {
            return $this->getAliases($formId);
        }

        return $this->database->fetchFirstColumn('SELECT alias FROM tl_oneup_form_field WHERE pid = ?', [(int) $record['pid']]);
    }

    private function getRootFormId(array $record): ?int
    {
        $pid = (int) $record['pid'];
        $ptable = (string) ($record['ptable'] ?? 'tl_oneup_form');

        while ('tl_oneup_form_field' === $ptable) {
            $parent = $this->database->fetchAssociative('SELECT pid, ptable FROM tl_oneup_form_field WHERE id = ?', [$pid]);

            if (false === $parent) {
                return null;
            }

            $pid = (int) $parent['pid'];
            $ptable = (string) $parent['ptable'];
        }

        return $pid ?: null;
    }

    private function getAliases(int $pid, string $ptable = 'tl_oneup_form'): array
    {
        $aliases = [];

        $rows = $this->database->fetchAllAssociative('SELECT id, alias FROM tl_oneup_form_field WHERE pid = ? AND ptable = ?', [$pid, $ptable]);

        foreach ($rows as $row) {
            $aliases[] = (string) $row['alias'];
            $aliases = [...$aliases, ...$this->getAliases((int) $row['id'], 'tl_oneup_form_field')];
        }

        return $aliases;
    }
}
