<?php

declare(strict_types=1);

namespace Core\Router;

final class Router
{
    public static string $controllerName = \App\Controllers\HomeController::class;
    public static string $actionName = 'index';
    public static array $data = [];
    public static array $routes = [];


    public static function start(array $params = []): void
    {
        $uri = $_SERVER['REQUEST_URI'];
        self::getRoutes($uri);
        self::$data = $params ?? $_GET;

        foreach (self::$routes as $regexp => $actions) {
            if (preg_match($regexp, $uri)) {
                self::prepare(...$actions);
            }
        }

        self::execute();
    }


    private static function execute(): void
    {
        $controller = new self::$controllerName;
        $action = self::$actionName;
        $controller->$action(self::$data);
    }

    private static function getRoutes(string $uri): void
    {
        $routes = explode('/', $uri);
        self::$routes = match ($routes[1]) {
            'api' => include $_SERVER['DOCUMENT_ROOT'].'/routes/api.php',
            default => include $_SERVER['DOCUMENT_ROOT'].'/routes/web.php',
        };
    }

    private static function prepare(string $class, string $action, string $method = 'GET'): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== $method) {
            return;
        }

        self::$controllerName = $class;
        self::$actionName = $action;

        self::$data = match ($method) {
            'GET' => self::$data,
            'POST' => $_POST ?? json_decode(file_get_contents('php://input'), true, 512),
        };
    }
}