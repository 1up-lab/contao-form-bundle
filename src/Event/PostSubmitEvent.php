<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Event;

use Oneup\ContaoFormBundle\File\StoredFiles;
use Oneup\ContaoFormBundle\Model\FormModel;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;

class PostSubmitEvent
{
    public ?Response $response = null;

    public function __construct(
        public FormInterface $form,
        public FormModel $formModel,
        public readonly StoredFiles $storedFiles,
    ) {
    }
}
