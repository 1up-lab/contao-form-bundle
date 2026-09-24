<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\CoreBundle\Mailer\AvailableTransports;

#[AsCallback(table: 'tl_oneup_form', target: 'fields.mailerTransport.options')]
class MailerTransportOptionListener
{
    public function __construct(
        private readonly AvailableTransports $availableTransports,
    ) {
    }

    public function __invoke(): array
    {
        return $this->availableTransports->getTransportOptions();
    }
}
