<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\CertificateService;
use App\Config\Config;
use App\Services\AuthService;

class CertificateController extends Controller
{
    private CertificateService $certificate_service;

    public function __construct(CertificateService $certificate_service)
    {
        $this->certificate_service = $certificate_service;
    }

    public function index()
    {
        AuthService::check();
        $certificates = $this->certificate_service->getCertificates();
        $this->renderView('certificates/index', 'layouts/main', [
            "page_title" => "Manajemen Sertifikat",
            "certificates" => $certificates
        ]);
    }

    public function show($id): void
    {
        $certificate = $this->certificate_service->findCertificate($id);

        if ($certificate) {
            $this->renderView("certificates/show", isset($_SESSION['user']) ? 'layouts/main' : 'layouts/base', [
                'id' => $id,
                'page_title' => 'Sertifikat Trustmedis'
            ]);
        } else {
            $this->showExpire();
        }
    }

    public function showExpire(): void
    {
        $this->renderView("certificates/expired", isset($_SESSION['user']) ? 'layouts/main' : 'layouts/base', [
            "page_title" => "Sertifikat Sudah Terhapus",
            "title_text" => "Mohon Maaf",
            "desc_text" => "Sertifikat tidak dapat diakses karena telah terhapus dari sistem.",
        ]);
    }

    public function download(string $id): void
    {
        $this->certificate_service->downloadCertificate($id);
    }

    public function destroy(string $id)
    {
        AuthService::check();
        $this->certificate_service->deleteCertificate($id);
        $this->redirect();
    }

    public function search()
    {
        $input = $_POST['input'];
        $certificates = $this->certificate_service->searchCertificates($input);
        $this->renderView('certificates/table', 'layouts/base', [
            "certificates" => $certificates
        ]);
    }

    protected function redirect()
    {
        header("Location: " . Config::BASE_URL . "/certificates", true, 303);
        exit;
    }
}
