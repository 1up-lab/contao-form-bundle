<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form;

use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

class FormRegistry
{
    public function __construct(
        #[AutowireIterator(tag: 'oneup_contao_form.field', indexAttribute: 'type')]
        private readonly iterable $formTypes,
    ) {
    }

    public function get(string $name): FormFieldInterface
    {
        $formTypes = iterator_to_array($this->formTypes);

        if (!\array_key_exists($name, $formTypes)) {
            throw new \InvalidArgumentException();
        }

        return $formTypes[$name];
    }
}
