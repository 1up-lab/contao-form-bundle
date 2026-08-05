<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Field;

use Oneup\ContaoFormBundle\Attribute\AsFormField;
use Oneup\ContaoFormBundle\Form\AbstractField;
use Oneup\ContaoFormBundle\Form\FormFieldInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;

#[AsFormField('group', FormType::class, constrainable: false, nestable: true)]
class Group extends AbstractField implements FormFieldInterface
{
}
