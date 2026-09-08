<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Type;

use Oneup\ContaoFormBundle\Form\FieldBuilder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContaoStepType extends AbstractType
{
    public function __construct(
        private readonly FieldBuilder $fieldBuilder,
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->fieldBuilder->build($builder, (int) $options['field_id'], 'tl_oneup_form_field');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->define('field_id')
            ->info('ID of the tl_oneup_form_field record holding the fields of this step')
            ->required()
            ->allowedTypes('int')
        ;

        $resolver->setDefault('label', false);
    }
}
