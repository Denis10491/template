<?php

declare(strict_types=1);

namespace Core\View;

final class Component
{
    /**
     * Renders and passes data to the component at /app/Views/Components/.
     * 
     * @param string $componentName
     * @param array $data
     * 
     * @return void
     */
    static public function render(string $componentName, array $data = []): void
    {
        if (isset($data)) {
            extract($data);
        }

        include_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/Components/' . $componentName . '.component.php';
    }
}