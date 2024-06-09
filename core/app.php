<?php

declare(strict_types=1);

if (getenv('PRODUCTION_MODE') === false) {
    ini_set('display_errors', true);
    error_reporting(E_ALL);
}

\Core\Database\Database::getInstance();
