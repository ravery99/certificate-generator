<?php

namespace App\Controllers;

class Controller
{
    protected function renderView(string $viewPath, array $data = [], string $title = "Sertifikat Trustmedis")
    {
        extract($data);
        require_once __DIR__ . '/../../src/Views/layout.php';
    }
}
