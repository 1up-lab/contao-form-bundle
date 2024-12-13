<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener;

use Oneup\ContaoFormBundle\Event\PostSubmitEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;

#[AsEventListener(event: PostSubmitEvent::class)]
class RedirectAfterSubmitListener
{
    public function __construct(
        private readonly RouterInterface $router,
    ) {
    }

    public function __invoke(PostSubmitEvent $event): void
    {
        $config = $event->getForm();

        ['jumpTo' => $jumpTo] = $config;

        if (!$jumpTo) {
            return;
        }

        $event->setResponse(new RedirectResponse($this->router->generate('tl_page.' . $jumpTo)));
    }
}
