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

use Phuria\UnderQuery\Connection\ConnectionManagerInterface;
use Phuria\UnderQueryBundle\Connection\DoctrineConnection;
use Doctrine\DBAL\Driver\Connection as DBALConnectionInterface;
use Phuria\UnderQueryBundle\Service\UnderQuery;

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
        static::assertInstanceOf(UnderQuery::class, $container->get('phuria_under_query'));
        static::assertSame($container->get('under_query'), $container->get('phuria_under_query'));
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

        /** @var UnderQuery $qbFactory */
        $qbFactory = $container->get('under_query');
        $internalContainer = $qbFactory->getContainer();

        /** @var ConnectionManagerInterface $connectionManger */
        $connectionManger = $internalContainer->get('phuria.sql_builder.connection_manager');

        static::assertInstanceOf(DoctrineConnection::class, $connectionManger->getConnection());
    }
}