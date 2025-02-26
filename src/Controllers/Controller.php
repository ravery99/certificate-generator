<?php

namespace App\Controllers;

class Controller
{
    protected function renderView(string $view_path, array $data = [], string $page_title = "Sertifikat Trustmedis")
    {
        extract($data);
        require_once __DIR__ . '/../../src/Views/layout.php';
    }
}
