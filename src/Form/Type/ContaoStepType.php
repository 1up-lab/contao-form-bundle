<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Type;

use Oneup\ContaoFormBundle\Form\Builder\FieldBuilder;
use Oneup\ContaoFormBundle\Model\FieldModel;
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
        /** @var FieldModel $model */
        $model = $options['model'];

        $this->fieldBuilder->build($builder, $model->id, 'tl_oneup_form_field');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->define('model')
            ->info('The FieldModel instance')
            ->required()
            ->allowedTypes(FieldModel::class)
        ;

        $resolver->setDefault('label', false);
    }
}
