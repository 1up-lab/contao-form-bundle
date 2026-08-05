<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Field;

use Oneup\ContaoFormBundle\Attribute\AsFormField;
use Oneup\ContaoFormBundle\Form\AbstractField;
use Oneup\ContaoFormBundle\Form\FormFieldInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

#[AsFormField(name: 'text', formType: TextType::class)]
#[AsFormField(name: 'email', formType: EmailType::class)]
#[AsFormField(name: 'tel', formType: TelType::class)]
#[AsFormField(name: 'search', formType: SearchType::class)]
#[AsFormField(name: 'textarea', formType: TextareaType::class)]
class Text extends AbstractField implements FormFieldInterface
{
    public function resolveOptions(array $row): array
    {
        return [
            'required' => (bool) $row['required'],
            'label' => $row['label'] ?: $row['name'],
            'label_html' => (bool) $row['labelHtml'],
            'help' => $row['help'],
            'help_html' => (bool) $row['helpHtml'],
            'trim' => (bool) $row['trim'],
            'attr' => [
                'placeholder' => $row['placeholder'],
            ],
        ];
    }
}
