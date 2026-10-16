<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Field;

use Contao\CoreBundle\Altcha\Altcha as ContaoAltcha;
use Contao\CoreBundle\Controller\AltchaController;
use Contao\StringUtil;
use Oneup\ContaoFormBundle\Attribute\AsField;
use Oneup\ContaoFormBundle\Form\AbstractField;
use Oneup\ContaoFormBundle\Form\FieldInterface;
use Oneup\ContaoFormBundle\Form\Type\AltchaType;
use Oneup\ContaoFormBundle\Model\FieldModel;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Routing\RouterInterface;

#[AsField('altcha', AltchaType::class, constrainable: false)]
class Altcha extends AbstractField implements FieldInterface
{
    public function __construct(
        #[Autowire(service: 'contao.altcha')]
        private readonly ContaoAltcha $altcha,
        private readonly RouterInterface $router,
    ) {
    }

    public function resolveOptions(FieldModel $model): array
    {
        return [
            'label' => $model->label ?: $model->name,

            // Altcha specific
            'challengeurl' => $this->router->generate(AltchaController::class),
            'maxnumber' => $this->altcha->getRangeMax(),
            'strings' => $this->getLocalization(),
            'auto' => $model->altchaAuto,
            'hidelogo' => $model->altchaHideLogo,
            'hidefooter' => $model->altchaHideFooter,
            'floating' => $model->altchaFloating,
        ];
    }

    private function getLocalization(): string
    {
        return StringUtil::specialchars(json_encode([
            'error' => $GLOBALS['TL_LANG']['ERR']['altchaWidgetError'],
            'footer' => $GLOBALS['TL_LANG']['MSC']['altchaFooter'],
            'label' => $GLOBALS['TL_LANG']['MSC']['altchaLabel'],
            'verified' => $GLOBALS['TL_LANG']['MSC']['altchaVerified'],
            'verifying' => $GLOBALS['TL_LANG']['MSC']['altchaVerifying'],
            'waitAlert' => $GLOBALS['TL_LANG']['MSC']['altchaWaitAlert'],
        ], \JSON_THROW_ON_ERROR));
    }
}
