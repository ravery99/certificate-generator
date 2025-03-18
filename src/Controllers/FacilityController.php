<?php

namespace App\Controllers;

use App\Config\Config;
use App\Core\Controller;
use App\Services\AuthService;
use App\Services\FacilityService;

class FacilityController extends Controller
{
    private FacilityService $facility_service;

    public function __construct(FacilityService $facility_service)
    {
        AuthService::check();
        $this->facility_service = $facility_service;
    }
    public function index()
    {
        $facilities = $this->facility_service->getFacilities();
        $this->renderView('facilities/index', 'layouts/main', [
            "page_title" => "Tabel Fasilitas",
            "facilities" => $facilities
        ]);
    }

    public function create()
    {
        $this->renderView('facilities/create', 'layouts/main', [
            "page_title" => "Formulir Tambah Fasilitas Baru",
        ]);
    }

    public function store()
    {
        $this->facility_service->store();
        $this->redirect();
    }

    public function edit(string $id)
    {
        $facility = $this->facility_service->getFacility($id);
        $this->renderView('facilities/edit', 'layouts/main', ['id' => $id, 'facility_name' => $facility['name']]);
    }

    public function update(string $id)
    {
        $this->facility_service->update($id);
        $this->redirect();
    }

    public function destroy(string $id)
    {
        $this->facility_service->destroy($id);
        $this->redirect();
    }

    protected function redirect()
    {
        header("Location: " . Config::BASE_URL . "/facilities", true, 303);
        exit;
    }
}
