<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Type;

use Contao\CoreBundle\Altcha\Altcha as ContaoAltcha;
use Contao\CoreBundle\String\HtmlAttributes;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class AltchaType extends AbstractType
{
    public function __construct(
        #[Autowire(service: 'contao.altcha')]
        private readonly ContaoAltcha $altcha,
        private readonly RequestStack $requestStack
    ) {
    }

    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $attributes = new HtmlAttributes();
        $attributes->set('maxnumber', $options['maxnumber']);
        $attributes->set('challengeurl', $options['challengeurl']);
        $attributes->set('strings', $options['strings']);
        $attributes->set('name', $view->vars['full_name']);
        $attributes->setIfExists('auto', $options['auto']);
        $attributes->setIfExists('hidelogo', $options['hidelogo']);
        $attributes->setIfExists('hidefooter', $options['hidefooter']);
        $attributes->setIfExists('floating', $options['floating']);

        $view->vars['altchaAttributes'] = $attributes;
        $view->vars['canUseAltcha'] = $this->canUseAltcha();
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'translation_domain' => 'oneup_form_bundle',
            'error_bubbling' => false,
            'constraints' => [
                new Callback(function (mixed $value, ExecutionContextInterface $context): void {
                    if (!\is_string($value) || '' === $value || !$this->altcha->validate($value)) {
                        $context
                            ->buildViolation($GLOBALS['TL_LANG']['ERR']['altchaVerificationFailed'])
                            ->addViolation();
                    }
                }),
            ],
            'auto' => '',
            'hidelogo' => false,
            'hidefooter' => false,
            'floating' => false,
        ]);

        $resolver->setRequired([
            'challengeurl',
            'maxnumber',
            'strings',
        ]);

        $resolver->setAllowedTypes('challengeurl', ['null', 'string']);
        $resolver->setAllowedTypes('maxnumber', ['int']);
        $resolver->setAllowedTypes('strings', ['string']);
    }

    public function getParent(): string
    {
        return HiddenType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'altcha';
    }

    private function canUseAltcha(): bool
    {
        $request = $this->requestStack->getCurrentRequest();

        if (!$request) {
            return false;
        }

        if ($request->isSecure()) {
            return true;
        }

        $host = $request->getHost();

        return \in_array($host, ['127.0.0.1', 'localhost'], true) || str_ends_with($host, '.localhost');
    }
}
