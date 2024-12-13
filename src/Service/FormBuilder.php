<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Service;

use Contao\CoreBundle\Csrf\ContaoCsrfTokenManager;
use Doctrine\DBAL\Connection;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\NotBlank;

class FormBuilder
{
    public function __construct(
        private readonly ContaoCsrfTokenManager $contaoCsrfTokenManager,
        private readonly Connection $database,
        private readonly FormFactoryInterface $formFactory,
        private readonly ParameterBagInterface $parameterBag,
    ) {
    }

    public function build(int $id): FormInterface
    {
        $builder = $this->formFactory->createNamedBuilder('oneup_form_' . $id, options: [
            'csrf_field_name' => 'REQUEST_TOKEN',
            'csrf_token_manager' => $this->contaoCsrfTokenManager,
            'csrf_token_id' => $this->parameterBag->get('contao.csrf_token_name'),
        ]);

        $fields = $this->getFields($id);

        foreach ($fields as $field) {
            $builder->add($field['alias'], $field['type'], $this->getFieldOptions($field));
        }

        return $builder->getForm();
    }

    private function getFields(int $formId): array
    {
        return $this->database->createQueryBuilder()
            ->select('f.*')
            ->from('tl_oneup_form_field', 'f')
            ->andWhere('f.pid = :formId')
            ->addOrderBy('f.sorting')

            ->setParameter('formId', $formId)

            ->fetchAllAssociative()
        ;
    }

    private function getFieldOptions(array $field): array
    {
        $options = match ($field['type']) {
            TextType::class => [
                'required' => (bool) $field['required'],
                'label' => $field['label'] ?: $field['name'],
                'label_html' => (bool) $field['labelHtml'],
                'help' => $field['help'],
                'help_html' => (bool) $field['helpHtml'],
                'trim' => (bool) $field['trim'],
                'constraints' => $this->getConstraints($field['id']),
            ],
            SubmitType::class => [
                'label' => $field['label'] ?: $field['name'],
            ],

            default => [],
        };

        return $options;
    }

    private function getConstraints(int $fieldId): array
    {
        $constraints = $this->database->createQueryBuilder()
            ->select('f.*')
            ->from('tl_oneup_form_validator', 'f')
            ->andWhere('f.pid = :fieldId')
            ->addOrderBy('f.sorting')

            ->setParameter('fieldId', $fieldId)

            ->fetchAllAssociative()
        ;

        return array_map(function (array $constraint): Constraint {
            $type = $constraint['type'];

            return new $type(options: $this->getConstraintOptions($constraint));
        }, $constraints);
    }

    private function getConstraintOptions(array $constraint): array
    {
        return match ($constraint['type']) {
            NotBlank::class => [
                'message' => $constraint['overwriteMessage'] ? $constraint['message'] : null,
            ],

            default => [],
        };
    }
}
