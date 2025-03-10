<?php

namespace App\Services;

use App\Models\Facility;
use App\Core\Service;
use Exception;

class FacilityService extends Service
{
    private Facility $facility_model;

    public function __construct(Facility $facility_model)
    {
        parent::__construct(); 
        $this->facility_model = $facility_model;
    }

    public function getFacilities()
    {
        $facilities = $this->facility_model->getAllFacilities();
        return $facilities;
    }

    public function getFacility(string $id)
    {
        $facility = $this->facility_model->getFacilityById($id);
        return $facility;
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
        return $success ?? false;
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
        return $success ?? false;
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
        return $deleted ?? false;
    }
}