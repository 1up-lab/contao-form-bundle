<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle;

use Oneup\ContaoFormBundle\DependencyInjection\Compiler\FormFieldPass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class OneupContaoFormBundle extends AbstractBundle
{
    public function build(ContainerBuilder $container): void
    {
        // Must run before Symfony's AttributeAutoconfigurationPass (priority 100),
        // which is what actually invokes registered attribute autoconfigurators.
        $container->addCompilerPass(new FormFieldPass(), PassConfig::TYPE_BEFORE_OPTIMIZATION, 101);
    }

    public function loadExtension(array $config, ContainerConfigurator $configurator, ContainerBuilder $container): void
    {
        $configurator->import('../config/services.yaml');
    }
}
