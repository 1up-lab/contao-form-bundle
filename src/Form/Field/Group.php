<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Field;

use Oneup\ContaoFormBundle\Attribute\AsField;
use Oneup\ContaoFormBundle\Form\AbstractField;
use Oneup\ContaoFormBundle\Form\FieldInterface;
use Oneup\ContaoFormBundle\Model\FieldModel;
use Symfony\Component\Form\Extension\Core\Type\FormType;

#[AsField('group', FormType::class, constrainable: false, nestable: true)]
class Group extends AbstractField implements FieldInterface
{
    public function resolveOptions(FieldModel $model): array
    {
        $options = parent::resolveOptions($model);
        $options['required'] = true;

        return $options;
    }
}
