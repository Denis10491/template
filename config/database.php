<?php

return [
    'host' => getenv('MYSQL_CONTAINER'),
    'db' => getenv('MYSQL_DB'),
    'login' => getenv('MYSQL_LOGIN'),
    'password' => getenv('MYSQL_PASS'),
    'charset' => 'UTF8',
];