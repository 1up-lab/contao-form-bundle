<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener;

use Contao\StringUtil;
use Oneup\ContaoFormBundle\Event\PostSubmitEvent;
use Oneup\ContaoFormBundle\File\StoredFiles;
use Oneup\ContaoFormBundle\Form\Type\ContaoStepType;
use Oneup\ContaoFormBundle\Model\FormModel;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Form\Button;
use Symfony\Component\Form\ChoiceList\ChoiceListInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

#[AsEventListener(event: PostSubmitEvent::class)]
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
            ->htmlTemplate($this->getTemplate($formModel))
            ->textTemplate('@Contao/form/email_text.txt.twig')
            ->context([
                'form' => $formModel,
                'values' => $this->getValues($event->form, $event->storedFiles),
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

    private function getValues(FormInterface $form, StoredFiles $storedFiles): array
    {
        $values = [];

        foreach ($form as $child) {
            $values = [...$values, ...$this->getChildValues($child, $storedFiles)];
        }

        return $values;
    }

    private function getChildValues(FormInterface $child, StoredFiles $storedFiles): array
    {
        if ($child instanceof Button) {
            return [];
        }

        $innerType = $child->getConfig()->getType()->getInnerType();

        if ($innerType instanceof ContaoStepType || $innerType instanceof FormType) {
            return $this->getValues($child, $storedFiles);
        }

        return [
            [
                'label' => (string) ($child->getConfig()->getOption('label') ?: $child->getName()),
                'text' => $this->formatValue($this->getDisplayData($child)),
                'links' => $this->getFileLinks($child->getData(), $storedFiles),
            ],
        ];
    }

    private function getDisplayData(FormInterface $child): mixed
    {
        $choiceList = $child->getConfig()->getAttribute('choice_list');

        if (!$choiceList instanceof ChoiceListInterface) {
            return $child->getData();
        }

        $labels = $choiceList->getOriginalKeys();

        $label = static function (mixed $value) use ($labels): string {
            $value = \is_string($value) ? $value : '';

            return (string) ($labels[$value] ?? $value);
        };

        $values = $child->getViewData();

        if (!\is_array($values)) {
            return null === $values || '' === $values ? null : $label($values);
        }

        return array_map($label, $values);
    }

    private function getFileLinks(mixed $value, StoredFiles $storedFiles): array
    {
        $links = [];

        foreach (\is_array($value) ? $value : [$value] as $upload) {
            if (!$upload instanceof UploadedFile) {
                continue;
            }

            $file = $storedFiles->get($upload);

            if (null !== $file?->link) {
                $links[] = [
                    'name' => $file->name,
                    'url' => $file->link,
                ];
            }
        }

        return $links;
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
