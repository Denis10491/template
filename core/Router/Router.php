<?php

declare(strict_types=1);

namespace Core\Router;

use Core\Request\Request;
use Core\Response\Response;

final class Router
{
    protected string $controllerName = \App\Controllers\HomeController::class;
    protected string $actionName = 'index';
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function start(): void
    {   
        $routes = $this->loadRoutes();

        foreach ($routes as $regexp => $actions) {
            if (preg_match($regexp, $this->request->getUri()->getPath())) {
                $this->prepare(...$actions);
            }
        }

        $this->execute();
    }

    private function loadRoutes(): array
    {
        $path = $this->request->getUri()->getPath();
        $parts = explode('/', $path);

        return match ($parts[1]) {
            'api' => require $_SERVER['DOCUMENT_ROOT'] . '/routes/api.php',
            default => require $_SERVER['DOCUMENT_ROOT'] . '/routes/web.php',
        };
    }

    private function prepare(string $class, string $action, string $method = 'GET'): void
    {
        if ($this->request->getMethod() !== $method) {
            (new Response())->back()->withStatus(405, 'Method not allowed');
        }

        $this->controllerName = $class;
        $this->actionName = $action;
    }

    private function execute(): void
    {
        $controller = new $this->controllerName;
        $action = $this->actionName;
        $controller->$action($this->request);
    }
}