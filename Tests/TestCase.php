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

use Phuria\UnderQueryBundle\Tests\Fixtures\AppKernel;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * @author Beniamin Jonatan Šimko <spam@simko.it>
 */
class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var KernelInterface
     */
    private $kernel;

    /**
     * @return ContainerInterface
     */
    protected function getContainer()
    {
        return $this->kernel->getContainer();
    }

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        $this->kernel = new AppKernel('test', true);
        $this->kernel->boot();
    }

    /**
     * @inheritdoc
     */
    protected function tearDown()
    {
        $this->kernel->shutdown();
    }
}