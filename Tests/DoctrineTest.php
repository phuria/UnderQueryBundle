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

use Phuria\UnderQueryBundle\Service\QueryBuilderFactory;

/**
 * @author Beniamin Jonatan Šimko <spam@simko.it>
 */
class DoctrineTest extends TestCase
{
    /**
     * @test
     */
    public function itExecuteSimpleQuery()
    {
        /** @var QueryBuilderFactory $qbFactory */
        $qbFactory = $this->getContainer()->get('phuria.sql_builder');
        $qb = $qbFactory->createSelect();
        $qb->addSelect('1+1');
        $scalar = $qb->buildQuery()->fetchScalar();

        static::assertSame('2', $scalar);
    }
}