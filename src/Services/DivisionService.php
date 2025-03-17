<?php

namespace App\Services;

use App\Models\Division;
use App\Core\Service;
use Exception;

class DivisionService extends Service
{
    private Division $division_model;

    public function __construct(Division $division_model)
    {
        parent::__construct();
        $this->division_model = $division_model;
    }

    public function getDivisions()
    {
        $divisions = $this->division_model->getAllDivisions();
        return $divisions;
    }

    public function getDivision(string $id)
    {
        $division = $this->division_model->getDivisionById($id);
        return $division;
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
                    $success ? "Divisi baru berhasil ditambahkan!" : "Gagal menambahkan divisi '$name'. Terjadi kesalahan saat menyimpan data."
                );

                http_response_code($success ? 201 : 500);
            }
        } catch (Exception $e) {
            $this->exception_handler->handle($e, 'tambah', 'divisi');
        }
        return $success ?? false;
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
                    $success ? "Divisi dengan ID $id berhasil diperbarui!" : "Gagal memperbarui divisi dengan ID $id. Terjadi kesalahan saat menyimpan data."
                );

                http_response_code($success ? 200 : 500);
            }
        } catch (Exception $e) {
            $this->exception_handler->handle($e, 'edit', 'divisi', $id);
        }
        return $success ?? false;
    }

    public function destroy(string $id)
    {
        try {
            $deleted = $this->division_model->deleteDivision($id);
            $this->flash_service->set(
                $deleted ? "success" : "error",
                $deleted ? "Divisi dengan ID $id berhasil dihapus!" : "Divisi dengan ID $id sudah tidak tersedia. Silakan muat ulang halaman dan coba lagi."
            );

            http_response_code($deleted ? 200 : 404);
        } catch (Exception $e) {
            $this->exception_handler->handle($e, 'hapus', 'divisi', $id);
        }
        return $deleted ?? false;
    }
}
