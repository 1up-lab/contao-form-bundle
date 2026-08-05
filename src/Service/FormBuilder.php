<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Service;

use Contao\CoreBundle\Csrf\ContaoCsrfTokenManager;
use Oneup\ContaoFormBundle\Form\FormRegistry;
use Oneup\ContaoFormBundle\Form\Registry\ConstraintRegistry;
use Oneup\ContaoFormBundle\Model\FormFieldModel;
use Oneup\ContaoFormBundle\Model\FormValidatorModel;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

class FormBuilder
{
    public function __construct(
        private readonly ContaoCsrfTokenManager $contaoCsrfTokenManager,
        private readonly FormFactoryInterface $formFactory,
        private readonly FormRegistry $formRegistry,
        private readonly ConstraintRegistry $constraintRegistry,
        private readonly ParameterBagInterface $parameterBag,
    ) {
    }

    public function build(int $id): FormInterface
    {
        $builder = $this->formFactory->createNamedBuilder('oneup_form_' . $id, options: [
            'csrf_field_name' => 'REQUEST_TOKEN',
            'csrf_token_manager' => $this->contaoCsrfTokenManager,
            'csrf_token_id' => $this->parameterBag->get('contao.csrf_token_name'),
            'translation_domain' => false,
        ]);

        $this->buildForm($builder, $id);

        return $builder->getForm();
    }

    private function buildForm(FormBuilderInterface $builder, int $pid, string $ptable = 'tl_oneup_form'): void
    {
        /** @var FormFieldModel[] $fieldModels */
        $fieldModels = FormFieldModel::findBy('pid', $pid, [
            'ptable' => $ptable,
            'published' => true,
            'order' => 'sorting ASC',
        ]);

        if (null === $fieldModels) {
            return;
        }

        foreach ($fieldModels as $fieldModel) {
            $row = $fieldModel->row();

            try {
                $formType = $this->formRegistry->get($row['type']);
            } catch (\InvalidArgumentException) {
                continue;
            }

            $options = $formType->resolveOptions($row);

            if ($formType->isConstrainable()) {
                $options['constraints'] = $this->getConstraints($row['id']);

                dump($options);
            }

            $builder->add($row['alias'], $formType->getFormType(), $options);

            if ($formType->isNestable()) {
                $nestedBuilder = $builder->get($row['alias']);

                $this->buildForm($nestedBuilder, $row['id'], 'tl_oneup_form_field');
            }
        }
    }

    private function getConstraints(int $pid): array
    {
        $constraints = [];

        /** @var FormValidatorModel[] $constraintModels */
        $constraintModels = FormValidatorModel::findBy('pid', $pid, [
            'published' => true,
            'order' => 'sorting ASC',
        ]);

        if (null === $constraintModels) {
            return [];
        }

        foreach ($constraintModels as $constraintModel) {
            $row = $constraintModel->row();

            try {
                $constraintType = $this->constraintRegistry->get($row['type']);
            } catch (\InvalidArgumentException) {
                return [];
            }

            $constraints[] = new ($constraintType->getConstraintType())($constraintType->resolveOptions($row));
        }

        return $constraints;
    }
}
