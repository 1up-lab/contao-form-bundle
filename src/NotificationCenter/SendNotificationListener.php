<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\NotificationCenter;

use Oneup\ContaoFormBundle\Event\PostSubmitEvent;
use Oneup\ContaoFormBundle\Service\SubmissionValues;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Terminal42\NotificationCenterBundle\BulkyItem\FileItem;
use Terminal42\NotificationCenterBundle\NotificationCenter;
use Terminal42\NotificationCenterBundle\Parcel\Stamp\BulkyItemsStamp;

#[AsEventListener(event: PostSubmitEvent::class)]
class SendNotificationListener
{
    public function __construct(
        private readonly NotificationCenter $notificationCenter,
        private readonly SubmissionValues $submissionValues,
        private readonly SubmissionTokens $submissionTokens,
    ) {
    }

    public function __invoke(PostSubmitEvent $event): void
    {
        $formModel = $event->formModel;
        $notificationId = (int) $formModel->notification;

        if (!$formModel->sendNotification || $notificationId <= 0) {
            return;
        }

        $values = $this->submissionValues->fromEvent($event);
        $data = $this->submissionValues->dataFromEvent($event);

        $vouchers = $this->storeUploads($data);
        $tokens = $this->submissionTokens->create($values, $formModel->row(), $vouchers);

        $stamps = $this->notificationCenter->createBasicStampsForNotification($notificationId, $tokens);

        if ($vouchers) {
            $allVouchers = array_merge(...array_values($vouchers));
            $stamps = $stamps->with(new BulkyItemsStamp($allVouchers));
        }

        $this->notificationCenter->sendNotificationWithStamps($notificationId, $stamps);
    }

    private function storeUploads(array $data): array
    {
        $vouchers = [];

        foreach ($data as $name => $value) {
            $uploads = \is_array($value) ? $value : [$value];

            foreach ($uploads as $upload) {
                if ($upload instanceof UploadedFile && $upload->isFile()) {
                    $vouchers[$name][] = $this->storeUpload($upload);
                }
            }
        }

        return $vouchers;
    }

    private function storeUpload(UploadedFile $upload): string
    {
        $item = FileItem::fromPath(
            $upload->getPathname(),
            $upload->getClientOriginalName(),
            $upload->getClientMimeType() ?: 'application/octet-stream',
            (int) $upload->getSize(),
        );

        return $this->notificationCenter->getBulkyItemStorage()->store($item);
    }
}
