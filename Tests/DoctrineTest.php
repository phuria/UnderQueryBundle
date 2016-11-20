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

use Phuria\UnderQuery\UnderQuery;

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
        /** @var UnderQuery $uq */
        $uq = $this->getContainer()->get('under_query');
        $query = $uq->createSelect()->addSelect('1+1')->buildQuery();

        static::assertSame(1, $query->execute()->columnCount());
        static::assertSame('2', $query->execute()->fetchColumn());
    }
}