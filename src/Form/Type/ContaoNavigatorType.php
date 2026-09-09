<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Type;

use Symfony\Component\Form\Flow\Type\FinishFlowType;
use Symfony\Component\Form\Flow\Type\NavigatorFlowType;
use Symfony\Component\Form\Flow\Type\NextFlowType;
use Symfony\Component\Form\Flow\Type\PreviousFlowType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
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
                'label' => $this->translator->trans('form.previous'),
            ])
            ->add('next', NextFlowType::class, [
                'label' => $this->translator->trans('form.next'),
            ])
            ->add('submit', FinishFlowType::class, [
                'label' => $this->translator->trans('form.submit'),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'translation_domain' => 'oneup_form_bundle',
        ]);
    }
}
