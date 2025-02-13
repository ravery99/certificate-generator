<?php

namespace App\Controllers;

use App\Utils\CertificateService;

class CertificateController extends Controller
{

    public function showCertificate($email, $name, $timestamp): void
    {
        $certificate_service = new CertificateService();    
        $certificate = $certificate_service->findCertificate($email, $name, $timestamp); 
        $certificate ? $this->renderView("certificates", ['certificate' => $certificate]) 
                        : $this->showExpire();
    }

    public function showExpire(): void
    {
        $this->renderView("expired_certificate");
    }
}


