<?php

declare(strict_types=1);

$dotenv = fopen(__DIR__ . '/../.env', 'r');
if ($dotenv) {
    while (($line = fgets($dotenv)) !== false) {
        $line = trim($line);
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            putenv("$key=$value");
        }
    }
    fclose($dotenv);
}