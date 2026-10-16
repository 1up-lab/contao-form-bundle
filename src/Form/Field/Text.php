<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Field;

use Oneup\ContaoFormBundle\Attribute\AsField;
use Oneup\ContaoFormBundle\Form\AbstractField;
use Oneup\ContaoFormBundle\Form\FieldGroup;
use Oneup\ContaoFormBundle\Form\FieldInterface;
use Oneup\ContaoFormBundle\Model\FieldModel;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

#[AsField(name: 'text', formType: TextType::class, group: FieldGroup::Texts)]
#[AsField(name: 'email', formType: EmailType::class, group: FieldGroup::Texts)]
#[AsField(name: 'tel', formType: TelType::class, group: FieldGroup::Texts)]
#[AsField(name: 'search', formType: SearchType::class, group: FieldGroup::Texts)]
#[AsField(name: 'textarea', formType: TextareaType::class, group: FieldGroup::Texts)]
#[AsField(name: 'money', formType: MoneyType::class, group: FieldGroup::Moneys)]
#[AsField(name: 'range', formType: RangeType::class)]
#[AsField(name: 'password', formType: PasswordType::class)]
class Text extends AbstractField implements FieldInterface
{
    public function resolveOptions(FieldModel $model): array
    {
        $options = [
            ...parent::resolveOptions($model),
            'trim' => $model->trim,
        ];

        if ($model->placeholder) {
            $options['attr']['placeholder'] = $model->placeholder;
        }

        return $options;
    }
}
