<?php

spl_autoload_register(static function ($class_name): void {
    $parts = explode("\\", $class_name);
    $path = '';
    foreach ($parts as $key => $part) {
        if ($key !== 0) {
            $path .= "/" . ucfirst($part);
        } else {
            $path .= "/".strtolower($part);
        }
    }
    include_once $_SERVER['DOCUMENT_ROOT'] . $path . '.php';
});