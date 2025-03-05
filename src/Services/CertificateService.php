<?php

namespace App\Services;

use App\Models\Certificate;
use App\Config\DatabaseConfig;

class CertificateService {
    
    // private function formatText(string $text): string
    // {
        //     $clean_text = preg_replace('/[^A-Za-z0-9\-]/', '_', $text);
        //     return $clean_text;
    // }
    
    // public function formatCertificateFilename(string $email, string $name): string
    // {
        //     $clean_email = $this->formatText($email);
        //     $clean_name = $this->formatText($name);
        //     $timestamp = time();
        
        //     $filename = sprintf('%s-%s-%d.png', $clean_email, $clean_name, $timestamp);
        //     return $filename;
    // }
            
    
    // public function formatCertificateLink(string $certificate_filename): string
    // {
    //     $filename = $this->parseCertificateFilename($certificate_filename);
    //     $link = "/certificate/" . $filename['email'] . "/" . $filename['name'] . "/" . $filename['timestamp'];
    //     return $link;
    // }
    
    // private function parseCertificateFilename(string $filename): array
    // {
    //     $filename_without_ext = pathinfo($filename, PATHINFO_FILENAME);
    //     $parts = explode('-', $filename_without_ext, 3);

    //     // if (count($parts) !== 3 || !is_numeric($parts[2])) {
    //         //     throw new \InvalidArgumentException("Invalid certificate filename format: $filename");
    //         // }
            
    //         return [
    //             'email' => $parts[0],
    //             'name' => $parts[1],
    //             'timestamp' => (int) $parts[2],
    //         ];
    //     }
        
    //     public function findCertificate(string $email, string $name, string $timestamp): string
    //     {
    //         $path = __DIR__ . "/../../storage/certificates"; 
    //         $filename = "$email-$name-$timestamp.png";
    //         $file = $path . DIRECTORY_SEPARATOR . $filename;
    //         $base_url = "http://localhost/certificate-generator/storage/certificates";
            
    //     return (file_exists($file) && is_readable($file)) ? 
    //     "$base_url/$filename" : "";
    // }

    // diatas itu yang lama, dibawah ini yg baru
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
        
    public function findCertificate(string $id): array
    {
        $path = __DIR__ . "/../../storage/certificates"; 
        $filename = "$id.png";
        $file = $path . DIRECTORY_SEPARATOR . $filename;
        $base_url = "http://localhost/certificate-generator/storage/certificates";
        
        return (file_exists($file) && is_readable($file)) ? 
                ['url' => $base_url, 'path' => $file] : [];
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

    public function getCertificates(DatabaseConfig $db)
    {
        $certificate_model = new Certificate($db);
        return $certificate_model->getAllCertificates();
    }

    public function deleteCertificates(DatabaseConfig $db, string $id): bool
    {
        $certificate_model = new Certificate($db);
        return $certificate_model->deleteCertificate($id);
    }
}