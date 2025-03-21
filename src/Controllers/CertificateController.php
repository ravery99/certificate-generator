<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\CertificateService;
use App\Config\Config;
use App\Config\DatabaseConfig;
use Exception;

class CertificateController extends Controller
{
    private CertificateService $certificate_service;
    
    public function __construct(CertificateService $certificate_service)
    { 
        $this->certificate_service = $certificate_service;
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
<<<<<<< HEAD
        // $this->renderView("expired_certificate", "layout");
        $this->renderView("certificates/expired", "layouts/main"); //layout_path nya benerin lagi, yg atas juga
=======
        $this->renderView("certificates/expired", "layouts/main"); //layout_path nya sesuaiin lagi
>>>>>>> 7dbaa110ae7cbec935e75031511b63e66790f254
    }

    public function download(string $id): void
    {
        $this->certificate_service->downloadCertificate( $id);
    }

    public function destroy(string $id)
    {
        $this->certificate_service->deleteCertificate( $id);
        $this->redirect();
    }

    protected function redirect()
    {
        header("Location: " . Config::BASE_URL . "/certificates", true, 303);
        exit;
    }
}


