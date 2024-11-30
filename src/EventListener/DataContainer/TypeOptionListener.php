<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

#[AsCallback(table: 'tl_symfony_form', target: 'fields.type.options')]
class TypeOptionListener
{
    public function __invoke(): array
    {
        return [
            TextType::class,
            TextareaType::class,
            HiddenType::class,
        ];
    }
}
