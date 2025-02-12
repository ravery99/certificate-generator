<?php

namespace App\Models;

use DateTime;
use IntlDateFormatter;


class Participant
{
	private array $data;
    

    public function __construct( $data )
    {
        $this->data = $data;
        $this->formatTrainingDateToLocale();
        $this->setCertificate();
    }

	public function getEmail(): string 
    {
        return $this->data['email'];
    }
    

	public function getTrainingDate(): string 
    {
        return $this->data['tanggal_training'];
    }

    private function formatTrainingDateToLocale(): void
    {
        $date_object = new DateTime($this->getTrainingDate());

        // Formatter untuk tanggal dalam bahasa Indonesia
        $formatter = new IntlDateFormatter(
            'id_ID', 
            IntlDateFormatter::FULL, 
            IntlDateFormatter::NONE, 
            'Asia/Jakarta', 
            IntlDateFormatter::GREGORIAN,
            'd MMMM yyyy'
        );

        $this->training_date = $formatter->format($date_object);
    }

	public function getName(): string 
    {
        return $this->data['nama_peserta'];
    }

	public function getDivision(): string 
    {
        return $this->data['divisi'];
    }

	public function getFacility(): string
     {
        return $this->data['fasilitas_kesehatan'];
    }

	public function getPhoneNumber(): string
     {
        return $this->data['no_hp'];
    }
    public function getCertificatePath(): string 
    {
        return $this->data['lokasi_sertifikat'];
    }
    
    public function setCertificate(): void 
    {
        $certificate = new Certificate($this);
        $this->data['lokasi_sertifikat'] = $certificate->generate();
        $this->setCertificateLink(data['lokasi_sertifikat']);
        // $this->data['tautan_sertifikat'] = $this->getCertificateLink();
    }
    
    public function findCertificate(string $email, string $name, string $timestamp): string
    {
        $path = realpath(__DIR__ . "/../../storage/certificates"); 
        $file = "$path/" . basename($email) . "-" . basename($name) . "-" . basename($timestamp) . ".png"; 
    
        return (file_exists($file) && is_readable($file)) ? $file : "";
    }

    public function getCertificateLink(): string
    {
        return $this->data['tautan_sertifikat'];
    }

    public function setCertificateLink(string $path): void
    {
        $certificateFilename = $this->parseFilename($path);
        $this->data['tautan_sertifikat'] = "http://localhost/certificate-generator/public/" . $certificateFilename['email'] . "/" . $certificateFilename['name'] . "/" . $certificateFilename['timestamp'];
    }

    private function parseFilename(string $filename): array
    {
        $filenameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);
        $parts = explode('-', $filenameWithoutExtension);
        // if (count($parts) < 3) {
        //     throw new Exception('Format nama file tidak valid.');
        // }
        $timestamp = array_pop($parts);
        $name = array_pop($parts);
        $email = implode('-', $parts);

        return [
            'email' => $email,
            'name' => $name,
            'timestamp' => (int)$timestamp,
        ];
    }

}
