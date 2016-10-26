<?php

/**
 * This file is part of UnderQuery package.
 *
 * Copyright (c) 2016 Beniamin Jonatan Šimko
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phuria\UnderQueryBundle\Tests;

use Phuria\SQLBuilder\Connection\ConnectionManagerInterface;
use Phuria\UnderQueryBundle\Connection\DoctrineConnection;
use Phuria\UnderQueryBundle\Service\QueryBuilderFactory;
use Doctrine\DBAL\Driver\Connection as DBALConnectionInterface;

/**
 * @author Beniamin Jonatan Šimko <spam@simko.it>
 */
class ContainerTest extends TestCase
{
    /**
     * @test
     */
    public function itHasQueryBuilderFactory()
    {
        $container = $this->getContainer();
        static::assertInstanceOf(QueryBuilderFactory::class, $container->get('phuria.sql_builder'));
    }

    /**
     * @test
     */
    public function itHasDoctrineConnection()
    {
        $container = $this->getContainer();
        /** @var DBALConnectionInterface $connection */
        $connection = $container->get('doctrine')->getConnection();
        static::assertInstanceOf(DBALConnectionInterface::class, $connection);

        /** @var QueryBuilderFactory $qbFactory */
        $qbFactory = $container->get('phuria.sql_builder');
        $internalContainer = $qbFactory->getContainer();

        /** @var ConnectionManagerInterface $connectionManger */
        $connectionManger = $internalContainer['phuria.sql_builder.connection_manager'];

        static::assertInstanceOf(DoctrineConnection::class, $connectionManger->getConnection());
    }
}