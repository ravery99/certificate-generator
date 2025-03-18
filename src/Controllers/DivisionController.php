<?php

namespace App\Controllers;

use App\Config\Config;
use App\Core\Controller;
use App\Services\AuthService;
use App\Services\DivisionService;

class DivisionController extends Controller
{
    private DivisionService $division_service;

    public function __construct(DivisionService $division_service)
    {
        AuthService::check();
        $this->division_service = $division_service;
    }

    public function index()
    {
        $divisions = $this->division_service->getDivisions();
        $this->renderView('divisions/index', 'layouts/main', [
            "page_title" => "Tabel Divisi",
            "divisions" => $divisions
        ]);
    }

    public function create()
    {
        $this->renderView('divisions/create', 'layouts/', [
            "page_title" => "Formulir Tambah Divisi Baru",
        ]);
    }

    public function store()
    {
        $this->division_service->store();
        $this->redirect();
    }

    public function edit(string $id)
    {
        $division = $this->division_service->getDivision($id);
        $this->renderView('divisions/edit', 'layouts/', ['id' => $id, 'division_name' => $division['name']]);
    }

    public function update(string $id)
    {
        $this->division_service->update($id);
        $this->redirect();
    }

    public function destroy(string $id)
    {
        $this->division_service->destroy($id);
        $this->redirect();
    }

    protected function redirect()
    {
        header("Location: " . Config::BASE_URL . "/divisions", true, 303);
        exit;
    }
}
