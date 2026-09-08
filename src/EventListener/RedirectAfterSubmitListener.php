<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener;

use Contao\CoreBundle\Routing\ContentUrlGenerator;
use Contao\PageModel;
use Oneup\ContaoFormBundle\Event\PostSubmitEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\RedirectResponse;

#[AsEventListener(event: PostSubmitEvent::class)]
class RedirectAfterSubmitListener
{
    public function __construct(
        private readonly ContentUrlGenerator $contentUrlGenerator,
    ) {
    }

    public function __invoke(PostSubmitEvent $event): void
    {
        $jumpTo = $event->formModel->jumpTo;

        if (!$jumpTo) {
            return;
        }

        $page = PageModel::findById($jumpTo);

        if (!$page instanceof PageModel) {
            return;
        }

        $event->response = new RedirectResponse($this->contentUrlGenerator->generate($page));
    }
}
