<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Constraint;

use Oneup\ContaoFormBundle\Attribute\AsConstraint;
use Oneup\ContaoFormBundle\Form\ConstraintInterface;
use Oneup\ContaoFormBundle\Model\ConstraintModel;
use Symfony\Component\Validator\Constraints\Image as ImageConstraint;

#[AsConstraint('image', ImageConstraint::class)]
class Image extends File implements ConstraintInterface
{
    protected array $messageOptions = [
        'maxSizeMessage',
        'extensionsMessage',
        'minWidthMessage',
        'maxWidthMessage',
        'minHeightMessage',
        'maxHeightMessage',
    ];

    public function resolveOptions(ConstraintModel $model): array
    {
        $options = parent::resolveOptions($model);

        foreach (['minWidth', 'maxWidth', 'minHeight', 'maxHeight'] as $dimension) {
            if (null !== $model->$dimension) {
                $options[$dimension] = (int) $model->$dimension;
            }
        }

        return $options;
    }
}
