<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener;

use Oneup\ContaoFormBundle\Event\PostSubmitEvent;
use Oneup\ContaoFormBundle\Model\SubmissionModel;
use Oneup\ContaoFormBundle\Service\SubmissionTitle;
use Oneup\ContaoFormBundle\Service\SubmissionValues;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: PostSubmitEvent::class)]
class SaveFormSubmissionListener
{
    public function __construct(
        private readonly SubmissionValues $submissionValues,
        private readonly SubmissionTitle $submissionTitle,
    ) {
    }

    public function __invoke(PostSubmitEvent $event): void
    {
        $formModel = $event->formModel;

        if (!$formModel->storeSubmissions) {
            return;
        }

        $data = $this->submissionValues->dataFromEvent($event);

        $submission = new SubmissionModel();
        $submission->pid = $formModel->id;
        $submission->tstamp = time();
        $submission->title = $this->submissionTitle->generate((string) $formModel->submissionTitle, $data, $event->storedFiles);
        $submission->data = (string) json_encode($this->submissionValues->fromEvent($event));

        $submission->save();
    }
}
