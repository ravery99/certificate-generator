<?php

namespace App\Controllers;

use App\Config\Config;
use App\Core\Controller;
use App\Models\Facility;
use App\Services\LogService;
use PDOException;
use Exception;

class FacilityController extends Controller
{
    private Facility $facility_model;

    public function __construct(Facility $facility_model)
    {
        parent::__construct(); 
        $this->facility_model = $facility_model;
    }

    public function index()
    {
        $facilities = $this->facility_model->getAllFacilities();
        $this->renderView('facilities/index', 'layouts/', [
            "page_title" => "Tabel Fasilitas", 
            "facilities" => $facilities
        ]);
    }

    public function create()
    {
        $this->renderView('facilities/create', 'layouts/', [
            "page_title" => "Formulir Tambah Fasilitas Baru", 
        ]);
    }

    public function store()
    {
        try {
            $name = trim($_POST['name']); 
            if ($this->facility_model->findFacilityByName($name)) {
                $this->flash_service->set("error", "Fasilitas '$name' sudah ada.");
                http_response_code(409);
            } else {
                $success = $this->facility_model->addFacility($name);
                $this->flash_service->set(
                    $success ? "success" : "error",
                    $success ? "Fasilitas baru berhasil ditambahkan!" : "Gagal menambahkan fasilitas '$name'. Terjadi kesalahan saat menyimpan data.");
    
                http_response_code($success ? 201 : 500);
            }
            
        } catch (Exception $e) { 
            $this->exception_handler->handle($e, 'tambah', 'fasilitas');
        }
        $this->redirect();
    }

    public function edit(string $id)
    {
        $facility = $this->facility_model->getFacilityById($id);
        $this->renderView('facilities/edit', 'layouts/', ['id' => $id, 'facility_name'=> $facility['name']]);
    }

    public function update(string $id)
    {
        try {
            $name = trim($_POST['name']); 
            if ($this->facility_model->findFacilityByName($name)) {
                $this->flash_service->set("error", "Fasilitas '$name' sudah ada.");
                http_response_code(409);
            } else {
                $success = $this->facility_model->updateFacility($id, $name);
                $this->flash_service->set(
                    $success ? "success" : "error",
                    $success ? "Fasilitas dengan ID $id berhasil diperbarui!" : "Gagal memperbarui fasilitas dengan ID $id. Terjadi kesalahan saat menyimpan data."
                );
                http_response_code($success ? 200 : 500);
            }
        } catch (Exception $e) { 
            $this->exception_handler->handle($e, 'edit', 'fasilitas', $id);
        }
        $this->redirect();
    }

    public function destroy(string $id)
    {
        try {
            $deleted = $this->facility_model->deleteFacility($id);
            $this->flash_service->set(
                $deleted ? "success" : "error",
                $deleted ? "Fasilitas dengan ID $id berhasil dihapus!" : "Fasilitas dengan ID $id sudah tidak tersedia. Silakan muat ulang halaman dan coba lagi.");

            http_response_code($deleted ? 200 : 404);
        } catch (Exception $e) { 
            $this->exception_handler->handle($e, 'hapus', 'fasilitas', $id);
        }
        $this->redirect();
    }

    protected function redirect(string|null $user_role = null, bool|null $success = null)
    {
        header("Location: " . Config::BASE_URL . "/facilities");
        exit;
    }
}