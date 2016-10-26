<?php

/**
 * This file is part of UnderQuery package.
 *
 * Copyright (c) 2016 Beniamin Jonatan Šimko
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phuria\UnderQueryBundle\Connection;

use Doctrine\DBAL\Driver\Connection;
use Doctrine\DBAL\Driver\Statement;
use Phuria\UnderQuery\Connection\ConnectionInterface;
use Phuria\UnderQuery\Parameter\QueryParameterInterface;

/**
 * @author Beniamin Jonatan Šimko <spam@simko.it>
 */
class DoctrineConnection implements ConnectionInterface
{
    /**
     * @var Connection
     */
    private $wrappedConnection;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->wrappedConnection = $connection;
    }
    /**
     * @param $SQL
     *
     * @return Statement
     */
    private function prepareStatement($SQL)
    {
        return $this->wrappedConnection->prepare($SQL);
    }

    /**
     * @param string                    $SQL
     * @param QueryParameterInterface[] $parameters
     *
     * @return Statement
     */
    private function getExecutedStatement($SQL, array $parameters = [])
    {
        $preparedStmt = $this->prepareStatement($SQL);

        foreach ($parameters as $parameter) {
            $preparedStmt->bindValue($parameter->getName(), $parameter->getValue());
        }

        $preparedStmt->execute();

        return $preparedStmt;
    }

    /**
     * @inheritdoc
     */
    public function fetchScalar($SQL, array $parameters = [])
    {
        $stmt = $this->getExecutedStatement($SQL, $parameters);

        if (0 < $stmt->rowCount()) {
            return $stmt->fetch(\PDO::FETCH_COLUMN);
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function fetchRow($SQL, array $parameters = [])
    {
        $stmt = $this->getExecutedStatement($SQL, $parameters);

        if (0 < $stmt->rowCount()) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        return [];
    }

    /**
     * @inheritdoc
     */
    public function fetchAll($SQL, array $parameters = [])
    {
        $stmt = $this->getExecutedStatement($SQL, $parameters);

        if (0 < $stmt->rowCount()) {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        return [];
    }

    /**
     * @inheritdoc
     */
    public function rowCount($SQL, array $parameters = [])
    {
        $stmt = $this->getExecutedStatement($SQL, $parameters);

        return $stmt->rowCount() ?: 0;
    }

    /**
     * @inheritdoc
     */
    public function execute($SQL, array $parameters = [])
    {
        $stmt = $this->getExecutedStatement($SQL, $parameters);

        return $stmt->rowCount() ?: 0;
    }
}