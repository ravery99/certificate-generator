<?php

namespace App\Services;

use App\Models\Certificate;
use App\Core\Service;
use Exception;

class CertificateService extends Service
{
    private Certificate $certificate_model;

    public function __construct(Certificate $certificate_model)
    {
        parent::__construct();
        $this->certificate_model = $certificate_model;
    }

    public function formatCertificateFilename(string $id): string
    {
        $filename = sprintf('%s.png', $id);
        return $filename;
    }

    public function formatCertificateLink(string $certificate_filename): string
    {
        $filename_without_ext = pathinfo($certificate_filename, PATHINFO_FILENAME);
        $link = "/certificates/$filename_without_ext";
        return $link;
    }

    public function findCertificate(string $id): string
    {
        $path = __DIR__ . "/../../storage/certificates";
        $filename = "$id.png";
        $file = $path . DIRECTORY_SEPARATOR . $filename;

        return (file_exists($file) && is_readable($file)) ?
            $file : "";
    }

    public function sendFileDownload(string $file_path, string $filename): void
    {
        if (!file_exists($file_path)) {
            http_response_code(404);
            echo "File tidak ditemukan.";
            return;
        }

        header('Content-Description: File Transfer');
        header('Content-Type: image/png');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));

        readfile($file_path);
        exit;
    }

    public function getCertificates()
    {
        $certificates = $this->certificate_model->getAllCertificates();
        return $certificates;
    }

    public function deleteCertificate(string $id): bool
    {
        try {
            $deleted = $this->certificate_model->deleteCertificate($id);

            $this->flash_service->set(
                $deleted ? "success" : "error",
                $deleted ? "Sertifikat dengan ID $id berhasil dihapus!" : "Sertifikat dengan ID $id sudah tidak tersedia. Silakan muat ulang halaman dan coba lagi."
            );

            http_response_code($deleted ? 200 : 404);
        } catch (Exception $e) {
            $this->exception_handler->handle($e, 'hapus', 'sertifikat', $id);
        }
        return $deleted ?? false;
    }

    public function downloadCertificate(string $id)
    {
        $certificate = $this->findCertificate($id);
        $this->sendFileDownload($certificate, "Sertifikat_Trustmedis.png");
    }
}
