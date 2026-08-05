<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Field;

use Oneup\ContaoFormBundle\Attribute\AsField;
use Oneup\ContaoFormBundle\Form\AbstractField;
use Oneup\ContaoFormBundle\Form\FormFieldInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;

#[AsField('group', FormType::class, constrainable: false, nestable: true)]
class Group extends AbstractField implements FormFieldInterface
{
}
