<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Service;

use Oneup\ContaoFormBundle\Event\PostSubmitEvent;
use Oneup\ContaoFormBundle\File\StoredFiles;
use Oneup\ContaoFormBundle\Form\Builder\FormBuilder;
use Oneup\ContaoFormBundle\Form\Type\ContaoStepType;
use Symfony\Component\Form\Button;
use Symfony\Component\Form\ChoiceList\ChoiceListInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Flow\FormFlowInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class SubmissionValues
{
    public function __construct(
        private readonly FormBuilder $formBuilder,
        private readonly ValueFormatter $valueFormatter,
    ) {
    }

    public function fromEvent(PostSubmitEvent $event): array
    {
        return $this->getValues($this->getSubmittedForm($event), $event->storedFiles);
    }

    private function getSubmittedForm(PostSubmitEvent $event): FormInterface
    {
        if (!$event->form instanceof FormFlowInterface) {
            return $event->form;
        }

        return $this->formBuilder->buildAllSteps($event->formModel, (array) $event->form->getData());
    }

    private function getValues(FormInterface $form, StoredFiles $storedFiles): array
    {
        $values = [];

        foreach ($form as $child) {
            if ($child instanceof Button) {
                continue;
            }

            $values[] = $this->getValue($child, $storedFiles);
        }

        return $values;
    }

    private function getValue(FormInterface $child, StoredFiles $storedFiles): array
    {
        $value = [
            'name' => $child->getName(),
            'label' => (string) ($child->getConfig()->getOption('label') ?: $child->getName()),
        ];

        $innerType = $child->getConfig()->getType()->getInnerType();

        if ($innerType instanceof ContaoStepType || $innerType instanceof FormType) {
            return [...$value, 'children' => $this->getValues($child, $storedFiles)];
        }

        return [
            ...$value,
            'text' => $this->valueFormatter->format($this->getDisplayData($child), $storedFiles),
            'links' => $this->getFileLinks($child->getData(), $storedFiles),
        ];
    }

    private function getDisplayData(FormInterface $child): mixed
    {
        $choiceList = $child->getConfig()->getAttribute('choice_list');

        if (!$choiceList instanceof ChoiceListInterface) {
            return $child->getData();
        }

        $labels = $choiceList->getOriginalKeys();
        $values = $child->getViewData();

        $label = static function (mixed $value) use ($labels): mixed {
            if (!\is_string($value) || '' === $value) {
                return $value;
            }

            return $labels[$value] ?? $value;
        };

        return \is_array($values) ? array_map($label, $values) : $label($values);
    }

    private function getFileLinks(mixed $value, StoredFiles $storedFiles): array
    {
        $uploads = \is_array($value) ? $value : [$value];
        $links = [];

        foreach ($uploads as $upload) {
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
}
