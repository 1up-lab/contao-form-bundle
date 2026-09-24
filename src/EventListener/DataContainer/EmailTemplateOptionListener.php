<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\CoreBundle\Twig\Finder\FinderFactory;

#[AsCallback(table: 'tl_oneup_form', target: 'fields.emailTemplate.options')]
class EmailTemplateOptionListener
{
    public function __construct(
        private readonly FinderFactory $finderFactory,
    ) {
    }

    public function __invoke(): array
    {
        return $this->finderFactory
            ->create()
            ->identifier('form/email')
            ->withVariants()
            ->extension('html.twig')
            ->excludePartials()
            ->asTemplateOptions()
        ;
    }
}
