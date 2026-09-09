<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Type;

use Contao\CoreBundle\Csrf\ContaoCsrfTokenManager;
use Contao\Model\Collection;
use Oneup\ContaoFormBundle\Model\FieldModel;
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
    ) {
    }

    public function buildFormFlow(FormFlowBuilderInterface $builder, array $options): void
    {
        $labels = [];

        foreach ($this->getSteps((int) $options['form_id']) as $step) {
            $alias = (string) $step->alias;

            if (!$alias) {
                continue;
            }

            $builder->addStep($alias, ContaoStepType::class, ['field_id' => (int) $step->id]);

            $labels[$alias] = (string) $step->name;
        }

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
            ->define('form_id')
            ->info('ID of the tl_oneup_form record this flow belongs to')
            ->required()
            ->allowedTypes('int')
        ;

        $resolver->setDefaults([
            'step_property_path' => '[_step]',
            'translation_domain' => false,
            'csrf_field_name' => 'REQUEST_TOKEN',
            'csrf_token_manager' => $this->contaoCsrfTokenManager,
            'csrf_token_id' => $this->tokenName,
        ]);
    }

    private function getSteps(int $formId): array
    {
        $steps = FieldModel::findBy(
            ['pid=?', 'ptable=?', 'published=?', 'type=?'],
            [$formId, 'tl_oneup_form', true, 'step'],
            ['order' => 'sorting ASC'],
        );

        return $steps instanceof Collection ? $steps->getModels() : [];
    }
}
