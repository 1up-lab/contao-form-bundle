<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener;

use Oneup\ContaoFormBundle\Event\PostSubmitEvent;
use Oneup\ContaoFormBundle\Model\FormSubmissionModel;
use Oneup\ContaoFormBundle\Service\SubmissionNameGenerator;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: PostSubmitEvent::class)]
class SaveFormSubmissionListener
{
    public function __construct(
        private readonly SubmissionNameGenerator $nameGenerator,
    ) {
    }

    public function __invoke(PostSubmitEvent $event): void
    {
        $formModel = $event->formModel;

        if (!$formModel->storeSubmissions) {
            return;
        }

        $data = $event->form->getData();
        $name = $this->nameGenerator->generate((string) $formModel->submissionExpression, $data);

        $submission = new FormSubmissionModel();
        $submission->pid = $event->formModel->id;
        $submission->tstamp = time();
        $submission->name = $name;
        $submission->data = json_encode($data);

        $submission->save();
    }
}
