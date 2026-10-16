<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\DependencyInjection\Compiler;

use Oneup\ContaoFormBundle\Attribute\AsConstraint;
use Oneup\ContaoFormBundle\Attribute\AsField;
use Oneup\ContaoFormBundle\Form\FieldGroup;
use Symfony\Component\DependencyInjection\ChildDefinition;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FormPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        $container->registerAttributeForAutoconfiguration(AsField::class, static function (ChildDefinition $definition, AsField $attribute, \Reflector $reflector) use ($container): void {
            if (!$reflector instanceof \ReflectionClass) {
                return;
            }

            $id = \sprintf('%s.%s', $reflector->getName(), $attribute->name);
            $group = $attribute->group instanceof FieldGroup ? $attribute->group->value : $attribute->group;

            $container->register($id, $reflector->getName())
                ->setAutowired(true)
                ->addTag('oneup_contao_form.field', ['type' => $attribute->name])
                ->addMethodCall('setName', [$attribute->name])
                ->addMethodCall('setFormType', [$attribute->formType])
                ->addMethodCall('setConstrainable', [$attribute->constrainable])
                ->addMethodCall('setNestable', [$attribute->nestable])
                ->addMethodCall('setGroup', [$group])
            ;
        });

        $container->registerAttributeForAutoconfiguration(AsConstraint::class, static function (ChildDefinition $definition, AsConstraint $attribute, \Reflector $reflector) use ($container): void {
            if (!$reflector instanceof \ReflectionClass) {
                return;
            }

            $id = \sprintf('%s.%s', $reflector->getName(), $attribute->name);

            $container->register($id, $reflector->getName())
                ->setAutowired(true)
                ->addTag('oneup_contao_form.constraint', ['type' => $attribute->name])
                ->addMethodCall('setName', [$attribute->name])
                ->addMethodCall('setConstraintType', [$attribute->constraintType])
            ;
        });
    }
}
