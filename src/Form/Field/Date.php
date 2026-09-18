<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Field;

use Oneup\ContaoFormBundle\Attribute\AsField;
use Oneup\ContaoFormBundle\Form\AbstractField;
use Oneup\ContaoFormBundle\Form\FieldInterface;
use Oneup\ContaoFormBundle\Model\FieldModel;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;

#[AsField(name: 'choice', formType: ChoiceType::class)]
#[AsField(name: 'checkbox', formType: CheckboxType::class)]
#[AsField(name: 'country', formType: CountryType::class)]
#[AsField(name: 'language', formType: LanguageType::class)]
#[AsField(name: 'radio', formType: RadioType::class)]
class Choice extends AbstractField implements FieldInterface
{
    public function resolveOptions(FieldModel $model): array
    {
        return [
            'required' => $model->required,
            'label' => $model->label ?: $model->name,
            'label_html' => $model->labelHtml,
            'help' => $model->help,
            'help_html' => $model->helpHtml,
            'trim' => $model->trim,
            'attr' => [
                'placeholder' => $model->placeholder,
            ],
        ];
    }
}
