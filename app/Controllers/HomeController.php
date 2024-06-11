<?php

declare(strict_types=1);

namespace App\Controllers;

use Core\Database\Database;
use Core\View\View;

class HomeController
{
    public function index(): void
    {

        Database::getInstance();    
        View::render('home');
    }
}