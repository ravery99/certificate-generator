<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\CertificateService;

class CertificateController extends Controller
{

    public function showCertificate($email, $name, $timestamp): void
    {
        $certificate_service = new CertificateService();    
        $certificate = $certificate_service->findCertificate($email, $name, $timestamp); 
        // $certificate ? $this->renderView("certificates", "layout", ['certificate' => $certificate, 'page_title' => 'Sertifikat Trustmedis']) 
        $certificate ? $this->renderView("certificates/show", "layout", ['certificate' => $certificate, 'page_title' => 'Sertifikat Trustmedis']) 
                        : $this->showExpire();
    }

    public function showExpire(): void
    {
        // $this->renderView("expired_certificate", "layout");
        $this->renderView("certificates/expired", "layout"); //layout_path nya benerin lagi, yg atas juga
    }
}


