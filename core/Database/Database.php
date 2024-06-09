<?php

declare(strict_types=1);

namespace Core\Database;

use Core\View\View;
use PDO;
use PDOException;

class Database
{
    static private PDO $instance;

    static public function getInstance(): PDO
    {
        if (isset(self::$instance)) {
            return self::$instance;
        }

        try {
            $config = require $_SERVER['DOCUMENT_ROOT'] .'/config/database.php';

            $dsn = "mysql:host={$config['host']};dbname={$config['db']};charset={$config['charset']}";

            self::$instance = new PDO($dsn, $config['login'], $config['password']);
            return self::$instance;
        } catch (PDOException) {
            View::error(500);
        }
    }
}