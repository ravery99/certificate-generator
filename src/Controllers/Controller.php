<?php

namespace App\Controllers;

class Controller
{
    protected function renderView(string $viewPath, array $data = [])
    {
        extract($data);
        require_once __DIR__ . '/../../src/Views/layout.php';
    }
}
