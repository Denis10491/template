<?php

declare(strict_types=1);

namespace Core\View;

final class View
{
    static public function render(string $viewName, array $data = []): void
    {
        if (isset($data)) {
            extract($data);
        }

        include_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/' . ucfirst($viewName) . 'View.php';
        exit;
    }

    static public function error(int $code = 500): void
    {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/Errors/' . $code . '.php';
        exit;
    }
}