<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Builder;

use Oneup\ContaoFormBundle\Form\Registry\ConstraintRegistry;
use Oneup\ContaoFormBundle\Form\Registry\FieldRegistry;
use Oneup\ContaoFormBundle\Model\ConstraintModel;
use Oneup\ContaoFormBundle\Model\FieldModel;
use Symfony\Component\Form\FormBuilderInterface;

class FieldBuilder
{
    public function __construct(
        private readonly FieldRegistry $fieldRegistry,
        private readonly ConstraintRegistry $constraintRegistry,
    ) {
    }

    public function build(FormBuilderInterface $builder, int $pid, string $ptable = 'tl_oneup_form'): void
    {
        $fieldModels = FieldModel::findBy(['pid=?', 'ptable=?', 'published=?'], [$pid, $ptable, true], [
            'order' => 'sorting ASC',
        ]);

        if (null === $fieldModels) {
            return;
        }

        foreach ($fieldModels as $model) {
            if ('step' === $model->type) {
                continue;
            }

            try {
                $formType = $this->fieldRegistry->get($model->type);
            } catch (\InvalidArgumentException) {
                continue;
            }

            $options = $formType->resolveOptions($model);

            if ($formType->isConstrainable()) {
                $options['constraints'] = $this->getConstraints($model->id);
            }

            $builder->add($model->alias, $formType->getFormType(), $options);

            if ($formType->isNestable()) {
                $nestedBuilder = $builder->get($model->alias);

                $this->build($nestedBuilder, $model->id, 'tl_oneup_form_field');
            }
        }
    }

    private function getConstraints(int $pid): array
    {
        $constraints = [];

        $constraintModels = ConstraintModel::findBy('pid', $pid, [
            'order' => 'sorting ASC',
        ]);

        if (null === $constraintModels) {
            return [];
        }

        foreach ($constraintModels as $model) {
            try {
                $constraintType = $this->constraintRegistry->get($model->type);
            } catch (\InvalidArgumentException) {
                continue;
            }

            $constraints[] = new ($constraintType->getConstraintType())($constraintType->resolveOptions($model));
        }

        return $constraints;
    }
}
