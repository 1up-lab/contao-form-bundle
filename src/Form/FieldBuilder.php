<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form;

use Contao\Model\Collection;
use Oneup\ContaoFormBundle\Form\Registry\ConstraintRegistry;
use Oneup\ContaoFormBundle\Form\Registry\FormRegistry;
use Oneup\ContaoFormBundle\Model\FieldModel;
use Oneup\ContaoFormBundle\Model\ConstraintModel;
use Symfony\Component\Form\FormBuilderInterface;

class FieldBuilder
{
    public function __construct(
        private readonly FormRegistry $formRegistry,
        private readonly ConstraintRegistry $constraintRegistry,
    ) {
    }

    public function build(FormBuilderInterface $builder, int $pid, string $ptable = 'tl_oneup_form'): void
    {
        $fieldModels = FieldModel::findBy(['pid=?', 'ptable=?', 'published=?'], [$pid, $ptable, true], [
            'order' => 'sorting ASC',
        ]);

        if (!$fieldModels instanceof Collection) {
            return;
        }

        foreach ($fieldModels as $fieldModel) {
            $row = $fieldModel->row();

            if ('step' === $row['type']) {
                continue;
            }

            try {
                $formType = $this->formRegistry->get($row['type']);
            } catch (\InvalidArgumentException) {
                continue;
            }

            $options = $formType->resolveOptions($row);

            if ($formType->isConstrainable()) {
                $options['constraints'] = $this->getConstraints((int) $row['id']);
            }

            $builder->add($row['alias'], $formType->getFormType(), $options);

            if ($formType->isNestable()) {
                $nestedBuilder = $builder->get($row['alias']);

                $this->build($nestedBuilder, (int) $row['id'], 'tl_oneup_form_field');
            }
        }
    }

    private function getConstraints(int $pid): array
    {
        $constraints = [];

        $constraintModels = ConstraintModel::findBy('pid', $pid, [
            'order' => 'sorting ASC',
        ]);

        if (!$constraintModels instanceof Collection) {
            return [];
        }

        foreach ($constraintModels as $constraintModel) {
            $row = $constraintModel->row();

            try {
                $constraintType = $this->constraintRegistry->get($row['type']);
            } catch (\InvalidArgumentException) {
                continue;
            }

            $constraints[] = new ($constraintType->getConstraintType())($constraintType->resolveOptions($row));
        }

        return $constraints;
    }
}
