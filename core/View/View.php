<?php

declare(strict_types=1);

namespace Core\View;

final class View
{
    /**
     * Renders and passes data to the View at /app/Views/.
     * 
     * @param string $viewName
     * @param array $data
     * 
     * @return void
     */
    static public function render(string $viewName, array $data = []): void
    {
        if (isset($data)) {
            extract($data);
        }

        include_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/' . ucfirst($viewName) . 'View.php';
        exit;
    }

    /**
     * Renders an error page depending on the code at /app/Views/Errors/.
    * 
    * @param int $code
    * 
    * @return void
    */
    static public function error(int $code = 500): void
    {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/Errors/' . $code . '.php';
        exit;
    }
}