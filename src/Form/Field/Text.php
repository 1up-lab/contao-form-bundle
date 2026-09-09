<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Field;

use Oneup\ContaoFormBundle\Attribute\AsField;
use Oneup\ContaoFormBundle\Form\AbstractField;
use Oneup\ContaoFormBundle\Form\FormFieldInterface;
use Oneup\ContaoFormBundle\Model\FieldModel;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

#[AsField(name: 'text', formType: TextType::class)]
#[AsField(name: 'email', formType: EmailType::class)]
#[AsField(name: 'tel', formType: TelType::class)]
#[AsField(name: 'search', formType: SearchType::class)]
#[AsField(name: 'textarea', formType: TextareaType::class)]
class Text extends AbstractField implements FormFieldInterface
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
