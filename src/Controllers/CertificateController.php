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
    
    public function __construct(CertificateService $certificate_service)
    { 
        $this->certificate_service = $certificate_service;
    }

    public function index()
    {
        $certificates = $this->certificate_service->getCertificates();
        $this->renderView('certificates/index', 'layouts/main', ["page_title" => "Tabel Sertifikat", $certificates]);
    }

    public function show($id): void
    {
        $certificate = $this->certificate_service->findCertificate($id); 
        
        if ($certificate) {
            $this->renderView("certificates/show", "layouts/main", [ //layout_path nya sesuaiin lagi
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
        $this->renderView("certificates/expired", "layouts/main"); //layout_path nya sesuaiin lagi
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


