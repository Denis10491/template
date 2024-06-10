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
 * Forming a Request $request
 * =========================================
 */
$uri = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$request = (new Request())
    ->withMethod($_SERVER['REQUEST_METHOD'])
    ->withRequestTarget('*')
    ->withUri(new Uri($uri));

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
