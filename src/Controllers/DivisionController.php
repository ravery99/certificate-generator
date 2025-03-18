<?php

namespace App\Controllers;

use App\Config\Config;
use App\Core\Controller;
use App\Models\Division;
use App\Services\FlashMessageService;
use App\Services\LogService;
use PDOException;
use Exception;

class DivisionController extends Controller
{
    private Division $division_model;

    public function __construct(Division $division_model)
    {
        parent::__construct(); 
        $this->division_model = $division_model;
    }

    public function index()
    {
        $divisions = $this->division_model->getAllDivisions();
        $this->renderView('divisions/index', 'layouts/main', [
            "page_title" => "Tabel Divisi", 
            "divisions" => $divisions
        ]);
    }

    public function create()
    {
        $this->renderView('divisions/create', 'layouts/main', [
            "page_title" => "Formulir Tambah Divisi Baru", 
        ]);
    }

    public function store()
    {
        try {
            $name = trim($_POST['name']); 
            if ($this->division_model->findDivisionByName($name)) {
                $this->flash_service->set("error", "Divisi '$name' sudah ada.");
                http_response_code(409);
            } else {
                $success = $this->division_model->addDivision($name);
                $this->flash_service->set(
                    $success ? "success" : "error",
                    $success ? "Divisi baru berhasil ditambahkan!" : "Gagal menambahkan divisi '$name'. Terjadi kesalahan saat menyimpan data.");
    
                http_response_code($success ? 201 : 500);
            }
            
        } catch (Exception $e) { 
            $this->exception_handler->handle($e, 'tambah', 'divisi');
        }
        $this->redirect();
    }

    public function edit(string $id)
    {
        $division = $this->division_model->getDivisionById($id);
        $this->renderView('divisions/edit', 'layouts/main', ['id' => $id, 'division_name'=> $division['name']]);
    }

    public function update(string $id)
    {
        try {
            $name = trim($_POST['name']); 
            if ($this->division_model->findDivisionByName($name)) {
                $this->flash_service->set("error", "Divisi '$name' sudah ada.");
                http_response_code(409);
            } else {
                $success = $this->division_model->updateDivision($id, $name);
                $this->flash_service->set(
                    $success ? "success" : "error",
                    $success ? "Divisi dengan ID $id berhasil diperbarui!" : "Gagal memperbarui divisi dengan ID $id. Terjadi kesalahan saat menyimpan data.");
    
                http_response_code($success ? 200 : 500);
            }
            
        } catch (Exception $e) { 
            $this->exception_handler->handle($e, 'edit', 'divisi', $id);
        }
        $this->redirect();
    }

    public function destroy(string $id)
    {
        try {
            $deleted = $this->division_model->deleteDivision($id);
            $this->flash_service->set(
                $deleted ? "success" : "error",
                $deleted ? "Divisi dengan ID $id berhasil dihapus!" : "Divisi dengan ID $id sudah tidak tersedia. Silakan muat ulang halaman dan coba lagi.");

            http_response_code($deleted ? 200 : 404);
        } catch (Exception $e) { 
            $this->exception_handler->handle($e, 'hapus', 'divisi', $id);
        }
        $this->redirect();
    }

    protected function redirect(string|null $user_role = null, bool|null $success = null)
    {
        header("Location: " . Config::BASE_URL . "/divisions", true, 303);
        exit;
    }
}