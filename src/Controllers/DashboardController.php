<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\AuthService;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    private DashboardService $dashboard_service;

    public function __construct(DashboardService $dashboard_service)
    {
        AuthService::check();
        $this->dashboard_service = $dashboard_service;
    }

    public function index()
    {
        $data = $this->dashboard_service->getData();
        $this->renderView("dashboard", "layouts/main", [
            "page_title" => "Beranda Admin",
            "data" => $data,
        ]);
    }
}
