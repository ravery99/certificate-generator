<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\CertificateService;
use App\Config\Config;
use App\Config\DatabaseConfig;
use Exception;

class CertificateController extends Controller
{

    // public function showCertificate($email, $name, $timestamp): void
    // {
    //     $certificate_service = new CertificateService();    
    //     $certificate = $certificate_service->findCertificate($email, $name, $timestamp); 
    //     // $certificate ? $this->renderView("certificates", "layout", ['certificate' => $certificate, 'page_title' => 'Sertifikat Trustmedis']) 
    //     $certificate ? $this->renderView("certificates/show", "layout", ['certificate' => $certificate, 'page_title' => 'Sertifikat Trustmedis']) 
    //                     : $this->showExpire();
    // }





    //diatas itu yang lama, dibawh ini yang baru

    private CertificateService $certificate_service;
    private DatabaseConfig $db;


    public function __construct(CertificateService $certificate_service, DatabaseConfig $db)
    {
        parent::__construct();
        $this->certificate_service = $certificate_service;
        $this->db = $db;
    }

    public function index()
    {
        $certificates = $this->certificate_service->getCertificates($this->db);
        $this->renderView('certificates/index', 'layouts/main', [
            "page_title" => "Tabel Sertifikat",
            "certificates" => $certificates
        ]);
    }

    public function show($id): void
    {
        $certificate = $this->certificate_service->findCertificate($id);

        if ($certificate) {
            $this->renderView("certificates/show", "layouts/main", [
                'certificate' => $certificate['url'],
                'id' => $id,
                'page_title' => 'Sertifikat Trustmedis'
            ]);
        } else {
            $this->showExpire();
        }
    }

    public function showExpire(): void
    {
        // $this->renderView("expired_certificate", "layout");
        $this->renderView("certificates/expired", "layouts/"); //layout_path nya benerin lagi, yg atas juga
    }

    public function download(string $id): void
    {
        $certificate = $this->certificate_service->findCertificate($id);
        $this->certificate_service->sendFileDownload($certificate['path'], "Sertifikat_Trustmedis.png");
    }

    public function destroy(string $id)
    {
        try {
            $deleted = $this->certificate_service->deleteCertificates($this->db, $id);
            db:

            $this->flash_service->set(
                $deleted ? "success" : "error",
                $deleted ? "Sertifikat dengan ID $id berhasil dihapus!" : "Sertifikat dengan ID $id sudah tidak tersedia. Silakan muat ulang halaman dan coba lagi."
            );

            http_response_code($deleted ? 200 : 404);

        } catch (Exception $e) {
            $this->exception_handler->handle($e, 'hapus', 'sertifikat', $id);
        }
        $this->redirect();
    }

    protected function redirect(string|null $user_role = null, bool|null $success = null)
    {
        header("Location: " . Config::BASE_URL . "/certificates", true, 303);
        exit;
    }
}


