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

use Doctrine\DBAL\Driver\Connection as ConnectionInterface;
use Phuria\UnderQuery\UnderQuery;

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
        $connection = $container->get('doctrine')->getConnection();

        /** @var UnderQuery $uq */
        $uq = $container->get('under_query');

        static::assertSame($connection, $uq->getConnection());
    }
}