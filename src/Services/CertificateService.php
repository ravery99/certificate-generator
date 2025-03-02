<?php

namespace App\Services;

class CertificateService {
    private function formatText(string $text): string
    {
        $clean_text = preg_replace('/[^A-Za-z0-9\-]/', '_', $text);
        return $clean_text;
    }

    public function formatCertificateFilename(string $email, string $name): string
    {
        $clean_email = $this->formatText($email);
        $clean_name = $this->formatText($name);
        $timestamp = time();

        $filename = sprintf('%s-%s-%d.png', $clean_email, $clean_name, $timestamp);
        return $filename;
    }

    public function formatCertificateLink(string $certificate_filename): string
    {
        $filename = $this->parseCertificateFilename($certificate_filename);
        $link = "/certificate/" . $filename['email'] . "/" . $filename['name'] . "/" . $filename['timestamp'];
        return $link;
    }

    private function parseCertificateFilename(string $filename): array
    {
        $filename_without_ext = pathinfo($filename, PATHINFO_FILENAME);
        $parts = explode('-', $filename_without_ext, 3);

        // if (count($parts) !== 3 || !is_numeric($parts[2])) {
        //     throw new \InvalidArgumentException("Invalid certificate filename format: $filename");
        // }

        return [
            'email' => $parts[0],
            'name' => $parts[1],
            'timestamp' => (int) $parts[2],
        ];
    }
    
    public function findCertificate(string $email, string $name, string $timestamp): string
    {
        $path = __DIR__ . "/../../storage/certificates"; 
        $filename = "$email-$name-$timestamp.png";
        $file = $path . DIRECTORY_SEPARATOR . $filename;
        $base_url = "http://localhost/certificate-generator/storage/certificates";
    
        return (file_exists($file) && is_readable($file)) ? 
                "$base_url/$filename" : "";
    }
}