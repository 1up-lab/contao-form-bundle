<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener;

use Contao\StringUtil;
use Oneup\ContaoFormBundle\Event\PostSubmitEvent;
use Oneup\ContaoFormBundle\Model\FormModel;
use Oneup\ContaoFormBundle\Service\SubmissionValues;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

#[AsEventListener(event: PostSubmitEvent::class)]
class SendViaEmailListener
{
    public function __construct(
        private readonly MailerInterface $mailer,
        private readonly SubmissionValues $submissionValues,
    ) {
    }

    public function __invoke(PostSubmitEvent $event): void
    {
        $formModel = $event->formModel;

        if (!$formModel->sendViaEmail) {
            return;
        }

        $recipients = $this->getRecipients($formModel);

        if (!$recipients) {
            return;
        }

        $email = (new TemplatedEmail())
            ->to(...$recipients)
            ->subject($formModel->subject)
            ->htmlTemplate($this->getTemplate($formModel))
            ->textTemplate('@Contao/form/email_text.txt.twig')
            ->context([
                'form' => $formModel,
                'values' => $this->submissionValues->fromEvent($event),
            ])
        ;

        foreach ($event->storedFiles->getAttachments() as $file) {
            $email->attachFromPath($file->pathname, $file->name);
        }

        if ($from = $this->getFrom()) {
            $email->from($from);
        }

        if ($formModel->mailerTransport) {
            $email->getHeaders()->addTextHeader('X-Transport', $formModel->mailerTransport);
        }

        $this->mailer->send($email);
    }

    private function getTemplate(FormModel $formModel): string
    {
        return '@Contao/' . ($formModel->emailTemplate ?: 'form/email') . '.html.twig';
    }

    private function getRecipients(FormModel $formModel): array
    {
        return array_values(array_filter(StringUtil::trimsplit(',', $formModel->recipient)));
    }

    private function getFrom(): ?Address
    {
        $email = (string) ($GLOBALS['TL_ADMIN_EMAIL'] ?? '');

        if ('' === $email) {
            return null;
        }

        return new Address($email, (string) ($GLOBALS['TL_ADMIN_NAME'] ?? ''));
    }
}
