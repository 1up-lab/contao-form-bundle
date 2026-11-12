<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle;

use Oneup\ContaoFormBundle\DependencyInjection\Compiler\FormPass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use Terminal42\NotificationCenterBundle\Terminal42NotificationCenterBundle;

class OneupContaoFormBundle extends AbstractBundle
{
    public function build(ContainerBuilder $container): void
    {
        // Must run before Symfony's AttributeAutoconfigurationPass (priority 100),
        // which is what actually invokes registered attribute autoconfigurators.
        $container->addCompilerPass(new FormPass(), PassConfig::TYPE_BEFORE_OPTIMIZATION, 101);
    }

    public function loadExtension(array $config, ContainerConfigurator $configurator, ContainerBuilder $container): void
    {
        $configurator->import('../config/services.yaml');

        if ($this->hasNotificationCenter($container)) {
            $configurator->import('../config/notification_center.yaml');
        }
    }

    private function hasNotificationCenter(ContainerBuilder $container): bool
    {
        $bundles = (array) $container->getParameter('kernel.bundles');

        return \in_array(Terminal42NotificationCenterBundle::class, $bundles, true);
    }
}
