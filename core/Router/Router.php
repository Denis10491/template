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

    /**
     * Starts the router.
     * 
     * @return void
     */
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

    /**
     * Loads all routers from the routes directory depending on the request.
     * 
     * @return array
     */
    private function loadRoutes(): array
    {
        $path = $this->request->getUri()->getPath();
        $parts = explode('/', $path);

        return match ($parts[1] ?? '') {
            'api' => require $_SERVER['DOCUMENT_ROOT'] . '/routes/api.php',
            default => require $_SERVER['DOCUMENT_ROOT'] . '/routes/web.php',
        };
    }

    /**
     * Accepts data from a matching route, prepares a request, checks for execution permission depending on the method.
     * 
     * @param string $class
     * @param string $action
     * @param string $method
     * 
     * @return void
     */
    private function prepare(string $class, string $action, string $method = 'GET'): void
    {
        if ($this->request->getMethod() !== $method) {
            (new Response())->back()->withStatus(405, 'Method not allowed');
        }

        $this->controllerName = $class;
        $this->actionName = $action;
    }

    /**
     * Executes the request. a controller is created and a method is called depending on the route.
     * 
     * @return void
     */
    private function execute(): void
    {
        $controller = new $this->controllerName;
        $action = $this->actionName;
        $controller->$action($this->request);
    }
}