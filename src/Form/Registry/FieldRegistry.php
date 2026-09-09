<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Registry;

use Oneup\ContaoFormBundle\Form\FieldInterface;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

class FieldRegistry
{
    public function __construct(
        #[AutowireIterator(tag: 'oneup_contao_form.field', indexAttribute: 'type')]
        private readonly iterable $types,
    ) {
    }

    public function get(string $name): FieldInterface
    {
        $types = iterator_to_array($this->types);

        if (!\array_key_exists($name, $types)) {
            throw new \InvalidArgumentException();
        }

        return $types[$name];
    }
}
