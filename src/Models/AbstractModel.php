<?php

declare(strict_types=1);

namespace APP\Models;

use APP\Exception\DataBaseException;
use Exception;
use PDO;

abstract class AbstractModel
{
    protected PDO $connection;

    private static array $configuration;

    public static function configuration($configuration): void
    {
        self::$configuration = $configuration['db'];
    }

    public function __construct()
    {
        try
        {
            $dsn = 'mysql:host='.self::$configuration['host'].';dbname='.self::$configuration['database'].';port='.self::$configuration['port'];
            $this->connection = new PDO($dsn, self::$configuration['user'], self::$configuration['password']);
        }
        catch(Exception $e)
        {
            throw new DataBaseException("Database connection problem detected.",400);
        }
    }
}