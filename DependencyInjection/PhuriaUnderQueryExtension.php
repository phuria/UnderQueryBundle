<?php

/**
 * This file is part of UnderQuery package.
 *
 * Copyright (c) 2016 Beniamin Jonatan Šimko
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phuria\UnderQueryBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * @author Beniamin Jonatan Šimko <spam@simko.it>
 */
class PhuriaUnderQueryExtension extends Extension
{
    /**
     * @inheritdoc
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
        $processedConfig = $this->processConfiguration(new Configuration(), $configs);

        $underQueryDefinition = $container->getDefinition('phuria_under_query');

        foreach ($processedConfig['connections'] as $connection) {
            $underQueryDefinition->addMethodCall('registerConnectionService', [$connection['service']]);
        }
    }
}