<?php

declare(strict_types=1);

use Core\Request\Request;
use Core\Router\Router;
use Core\Database\Database;
use Core\Request\Uri;

/**
 * =========================================
 * Loading variables from .env
 * =========================================
 */
require_once __DIR__ . '/.env.php';


/**
 * =========================================
 * Debug mode
 * =========================================
 */
if (getenv('PRODUCTION_MODE') === false) {
    ini_set('display_errors', true);
    error_reporting(E_ALL);
}

/**
 * =========================================
 * Log mode
 * =========================================
 */
ini_set('log_errors', true);
ini_set('error_log', '/var/log/php_error.log');


/**
 * =========================================
 * Forming a Request $request
 * =========================================
 */
$request = (new Request())
    ->withMethod($_SERVER['REQUEST_METHOD'])
    ->withRequestTarget('*')
    ->withUri(new Uri());

/**
 * =========================================
 * Initializing and starting the Router
 * =========================================
 */
(new Router($request))->start();


/**
 * =========================================
 * Initializing a Database connection
 * =========================================
 */
Database::getInstance();
