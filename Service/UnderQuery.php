<?php

/**
 * This file is part of UnderQuery package.
 *
 * Copyright (c) 2016 Beniamin Jonatan Šimko
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phuria\UnderQueryBundle\Service;

use Phuria\UnderQuery\UnderQuery as BaseFactory;
use Phuria\UnderQueryBundle\Connection\DoctrineConnection;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @author Beniamin Jonatan Šimko <spam@simko.it>
 */
class UnderQuery extends BaseFactory
{
    /**
     * @var ContainerInterface
     */
    private $externalContainer;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->externalContainer = $container;
        parent::__construct();
    }

    /**
     * @param $serviceName
     */
    public function registerConnectionService($serviceName)
    {
        $service = $this->externalContainer->get($serviceName);
        $connection = new DoctrineConnection($service);
        $this->registerConnection($connection);
    }
}