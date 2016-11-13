<?php

/**
 * This file is part of UnderQuery package.
 *
 * Copyright (c) 2016 Beniamin Jonatan Šimko
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phuria\UnderQueryBundle\Tests\Fixtures;

use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Phuria\UnderQueryBundle\PhuriaUnderQueryBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

/**
 * @author Beniamin Jonatan Šimko <spam@simko.it>
 */
class AppKernel extends Kernel
{
    /**
     * @inheritdoc
     */
    public function registerBundles()
    {
        return [
            new PhuriaUnderQueryBundle(),
            new DoctrineBundle()
        ];
    }

    /**
     * @inheritdoc
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config.yml');
    }

    /**
     * @inheritdoc
     */
    protected function getEnvParameters()
    {
        return array_merge(parent::getEnvParameters(), [
            'database.user'     => $GLOBALS['DB_USER'],
            'database.password' => $GLOBALS['DB_PASSWORD'],
            'database.dbname'   => $GLOBALS['DB_DBNAME'],
            'database.host'     => $GLOBALS['DB_HOST']
        ]);
    }
}