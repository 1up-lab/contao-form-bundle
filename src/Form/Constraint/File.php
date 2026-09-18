<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Constraint;

use Oneup\ContaoFormBundle\Attribute\AsConstraint;
use Oneup\ContaoFormBundle\Form\AbstractConstraint;
use Oneup\ContaoFormBundle\Form\ConstraintInterface;
use Oneup\ContaoFormBundle\Model\ConstraintModel;
use Symfony\Component\Validator\Constraints\File as FileConstraint;

#[AsConstraint('file', FileConstraint::class)]
class File extends AbstractConstraint implements ConstraintInterface
{
    protected array $messageOptions = ['maxSizeMessage', 'extensionsMessage'];

    public function resolveOptions(ConstraintModel $model): array
    {
        $options = parent::resolveOptions($model);

        if ('' !== (string) $model->maxSize) {
            $options['maxSize'] = $model->maxSize;
        }

        if ('' !== (string) $model->extensions) {
            $options['extensions'] = array_map('trim', explode(',', $model->extensions));
        }

        return $options;
    }
}
