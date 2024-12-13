<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Event;

use Symfony\Component\HttpFoundation\Response;

class PostSubmitEvent
{
    private ?Response $response = null;

    public function __construct(
        private readonly array $form,
    ) {
    }

    public function setResponse(Response $response): self
    {
        $this->response = $response;

        return $this;
    }

    public function getResponse(): Response
    {
        return $this->response;
    }

    public function getForm(): array
    {
        return $this->form;
    }
}
