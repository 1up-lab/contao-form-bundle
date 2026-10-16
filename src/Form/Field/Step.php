<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Field;

use Oneup\ContaoFormBundle\Attribute\AsField;
use Oneup\ContaoFormBundle\Form\AbstractField;
use Oneup\ContaoFormBundle\Form\FieldGroup;
use Oneup\ContaoFormBundle\Form\FieldInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;

#[AsField('step', FormType::class, constrainable: false, nestable: true, group: FieldGroup::Steps)]
class Step extends AbstractField implements FieldInterface
{
}
