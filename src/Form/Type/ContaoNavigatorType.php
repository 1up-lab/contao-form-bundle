<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Type;

use Symfony\Component\Form\Flow\Type\FinishFlowType;
use Symfony\Component\Form\Flow\Type\NavigatorFlowType;
use Symfony\Component\Form\Flow\Type\NextFlowType;
use Symfony\Component\Form\Flow\Type\PreviousFlowType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class ContaoNavigatorType extends NavigatorFlowType
{
    public function __construct(
        private readonly TranslatorInterface $translator,
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('previous', PreviousFlowType::class, [
                'label' => $this->translate('oneupFormPrevious', 'Back'),
            ])
            ->add('next', NextFlowType::class, [
                'label' => $this->translate('oneupFormNext', 'Continue'),
            ])
            ->add('finish', FinishFlowType::class, [
                'label' => $this->translate('oneupFormFinish', 'Submit'),
            ])
        ;
    }

    private function translate(string $key, string $fallback): string
    {
        $label = $this->translator->trans('MSC.' . $key, [], 'contao_default');

        return 'MSC.' . $key === $label ? $fallback : $label;
    }
}
