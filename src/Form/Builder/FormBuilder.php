<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Builder;

use Contao\CoreBundle\Csrf\ContaoCsrfTokenManager;
use Oneup\ContaoFormBundle\Form\Type\ContaoFormFlowType;
use Oneup\ContaoFormBundle\Model\FormModel;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

class FormBuilder
{
    public function __construct(
        private readonly ContaoCsrfTokenManager $contaoCsrfTokenManager,
        private readonly FormFactoryInterface $formFactory,
        private readonly FieldBuilder $fieldBuilder,
        #[Autowire(param: 'contao.csrf_token_name')]
        private readonly string $tokenName,
    ) {
    }

    public function build(FormModel $formModel): FormInterface
    {
        $name = 'oneup_form_' . $formModel->id;

        if ($formModel->isMultistep) {
            return $this->formFactory->createNamed($name, ContaoFormFlowType::class, [], ['form_id' => $formModel->id]);
        }

        $builder = $this->formFactory->createNamedBuilder($name, options: [
            'csrf_field_name' => 'REQUEST_TOKEN',
            'csrf_token_manager' => $this->contaoCsrfTokenManager,
            'csrf_token_id' => $this->tokenName,
            'translation_domain' => false,
        ]);

        $this->fieldBuilder->build($builder, $formModel->id);

        return $builder->getForm();
    }
}
