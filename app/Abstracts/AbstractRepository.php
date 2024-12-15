<?php

namespace App\Abstracts;

use PDO;
use Throwable;

abstract class AbstractRepository
{
    protected PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @template T
     * @param callable():T $callback
     * @return T
     * @throws Throwable
     */
    public function executeWithTransaction(callable $callback)
    {
        $this->connection->beginTransaction();
        try {
            $result = $callback();
            $this->connection->commit();
            return $result;
        } catch (Throwable $e) {
            $this->connection->rollBack();
            throw $e;
        }
    }
}
