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
        $data = $this->dashboard_service->getTotals();
        $participants = $this->dashboard_service->getParticipants();

        $this->renderView("dashboards/index", "layouts/main", [
            "page_title" => "Beranda",
            "data" => $data,
            "participants" => $participants,
        ]);
    }

    public function search()
    {
        $input = $_POST['input'];
        $participants = $this->dashboard_service->searchParticipants($input);
        $this->renderView("dashboards/table", "layouts/base", [
            "participants" => $participants,
        ]);
    }
}
