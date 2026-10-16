<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Type;

use Contao\CoreBundle\Csrf\ContaoCsrfTokenManager;
use Oneup\ContaoFormBundle\Form\Flow\UploadedFileDataStorage;
use Oneup\ContaoFormBundle\Model\FieldModel;
use Oneup\ContaoFormBundle\Model\FormModel;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Form\Flow\AbstractFlowType;
use Symfony\Component\Form\Flow\FormFlowBuilderInterface;
use Symfony\Component\Form\Flow\FormFlowInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContaoFormFlowType extends AbstractFlowType
{
    public function __construct(
        private readonly ContaoCsrfTokenManager $contaoCsrfTokenManager,
        #[Autowire(param: 'contao.csrf_token_name')]
        private readonly string $tokenName,
        #[Autowire('%kernel.project_dir%/system/tmp')]
        private readonly string $tempDir,
    ) {
    }

    public function buildFormFlow(FormFlowBuilderInterface $builder, array $options): void
    {
        /** @var FormModel $formModel */
        $formModel = $options['model'];
        $steps = FieldModel::findPublishedStepsByForm($formModel->id);

        $labels = [];

        foreach ($steps as $step) {
            $alias = (string) $step->alias;

            if (!$alias) {
                continue;
            }

            $builder->addStep($alias, ContaoStepType::class, ['model' => $step]);

            $labels[$alias] = (string) $step->name;
        }

        $builder->setDataStorage(new UploadedFileDataStorage($builder->getDataStorage(), $this->tempDir));
        $builder->setAttribute('step_labels', $labels);
        $builder->add('navigator', ContaoNavigatorType::class);
    }

    public function buildViewFlow(FormView $view, FormFlowInterface $form, array $options): void
    {
        $labels = $form->getConfig()->getAttribute('step_labels', []);

        foreach (['steps', 'visible_steps'] as $variable) {
            foreach (array_keys($view->vars[$variable] ?? []) as $name) {
                $view->vars[$variable][$name]['label'] = $labels[$name] ?? $name;
            }
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->define('model')
            ->info('The FormModel')
            ->required()
            ->allowedTypes(FormModel::class)
        ;

        $resolver->setDefaults([
            'step_property_path' => '[_step]',
            'translation_domain' => false,
            'csrf_field_name' => 'REQUEST_TOKEN',
            'csrf_token_manager' => $this->contaoCsrfTokenManager,
            'csrf_token_id' => $this->tokenName,
        ]);
    }
}
