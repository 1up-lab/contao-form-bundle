<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\DependencyInjection\Compiler;

use Oneup\ContaoFormBundle\Attribute\AsFormField;
use Symfony\Component\DependencyInjection\ChildDefinition;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FormFieldPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        $container->registerAttributeForAutoconfiguration(AsFormField::class, static function (ChildDefinition $definition, AsFormField $attribute, \ReflectionClass $reflector) use ($container): void {
            $id = \sprintf('%s.%s', $reflector->getName(), $attribute->name);

            $container->register($id, $reflector->getName())
                ->setAutowired(true)
                ->addTag('oneup_contao_form.field', ['type' => $attribute->name])
                ->addMethodCall('setName', [$attribute->name])
                ->addMethodCall('setFormType', [$attribute->formType])
                ->addMethodCall('setConstrainable', [$attribute->constrainable])
                ->addMethodCall('setNestable', [$attribute->nestable])
            ;
        });
    }
}
