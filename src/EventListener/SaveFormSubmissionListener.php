<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener;

use Oneup\ContaoFormBundle\Event\PostSubmitEvent;
use Oneup\ContaoFormBundle\File\StoredFiles;
use Oneup\ContaoFormBundle\Model\SubmissionModel;
use Oneup\ContaoFormBundle\Service\SubmissionNameGenerator;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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

        $data = (array) $event->form->getData();
        $name = $this->nameGenerator->generate((string) $formModel->submissionExpression, $data);

        $submission = new SubmissionModel();
        $submission->pid = $event->formModel->id;
        $submission->tstamp = time();
        $submission->name = $name;
        $submission->data = (string) json_encode($this->normalize($data, $event->storedFiles));

        $submission->save();
    }

    private function normalize(mixed $value, StoredFiles $storedFiles): mixed
    {
        if ($value instanceof UploadedFile) {
            return [
                'name' => $value->getClientOriginalName(),
                'path' => $storedFiles->get($value)?->path,
            ];
        }

        if (\is_array($value)) {
            return array_map(fn (mixed $item): mixed => $this->normalize($item, $storedFiles), $value);
        }

        return $value;
    }
}
