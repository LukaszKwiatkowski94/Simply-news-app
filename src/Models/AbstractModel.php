<?php

declare(strict_types=1);

namespace APP\Models;

use Exception;
use PDO;

/**
 * Class AbstractModel
 *
 * @package APP\Models
 */
abstract class AbstractModel
{
    protected PDO $connection;

    protected const TABLE_NEWS = 'SN_news';
    protected const TABLE_USERS = 'SN_users';
    protected const TABLE_CATEGORIES = 'SN_categories';
    protected const TABLE_COMMENTS = 'SN_comments';

    private static array $configuration;

    public static function configuration($configuration): void
    {
        self::$configuration = $configuration['db'];
    }

    public function __construct()
    {
        try {
            $dsn = 'mysql:host=' . self::$configuration['host'] . ';dbname=' . self::$configuration['database'] . ';port=' . self::$configuration['port'];
            $this->connection = new PDO($dsn, self::$configuration['user'], self::$configuration['password']);
        } catch (Exception $e) {
            throw new Exception("Database connection problem detected.", 400);
        }
    }
}
