<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener;

use Oneup\ContaoFormBundle\Event\PostSubmitEvent;
use Oneup\ContaoFormBundle\Model\SubmissionModel;
use Oneup\ContaoFormBundle\Service\SubmissionValues;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: PostSubmitEvent::class)]
class SaveFormSubmissionListener
{
    public function __construct(
        private readonly SubmissionValues $submissionValues,
    ) {
    }

    public function __invoke(PostSubmitEvent $event): void
    {
        $formModel = $event->formModel;

        if (!$formModel->storeSubmissions) {
            return;
        }

        $submission = new SubmissionModel();
        $submission->pid = $formModel->id;
        $submission->tstamp = time();
        $submission->data = (string) json_encode($this->submissionValues->fromEvent($event));

        $submission->save();
    }
}
