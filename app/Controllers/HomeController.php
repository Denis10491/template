<?php

declare(strict_types=1);

namespace App\Controllers;

use Core\View\View;

class HomeController
{
    public function index(): void
    {
        View::render('home');
    }
}