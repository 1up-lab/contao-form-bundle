<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener;

use Contao\StringUtil;
use Oneup\ContaoFormBundle\Event\PostSubmitEvent;
use Oneup\ContaoFormBundle\Form\Type\ContaoStepType;
use Oneup\ContaoFormBundle\Model\FormModel;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Form\Button;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

#[AsEventListener(event: PostSubmitEvent::class, priority: 50)]
class SendViaEmailListener
{
    public function __construct(
        private readonly MailerInterface $mailer,
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
            ->htmlTemplate('@Contao/form/email.html.twig')
            ->context([
                'form' => $formModel,
                'values' => $this->getValues($event->form),
            ])
        ;

        if ($from = $this->getFrom()) {
            $email->from($from);
        }

        $this->mailer->send($email);
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

    private function getValues(FormInterface $form): array
    {
        $values = [];

        foreach ($form as $child) {
            $values = [...$values, ...$this->getChildValues($child)];
        }

        return $values;
    }

    private function getChildValues(FormInterface $child): array
    {
        if ($child instanceof Button) {
            return [];
        }

        $innerType = $child->getConfig()->getType()->getInnerType();

        if ($innerType instanceof ContaoStepType || $innerType instanceof FormType) {
            return $this->getValues($child);
        }

        return [
            [
                'label' => (string) ($child->getConfig()->getOption('label') ?: $child->getName()),
                'text' => $this->formatValue($child->getData()),
            ],
        ];
    }

    private function formatValue(mixed $value): string
    {
        return match (true) {
            $value instanceof UploadedFile => $value->getClientOriginalName(),
            $value instanceof \DateTimeInterface => $value->format('Y-m-d H:i'),
            \is_bool($value) => $value ? '1' : '',
            \is_array($value) => $this->formatList($value),
            \is_object($value) => '',
            default => (string) $value,
        };
    }

    private function formatList(array $values): string
    {
        $items = array_map($this->formatValue(...), $values);

        return implode(', ', array_filter($items, static fn (string $item): bool => '' !== $item));
    }
}
