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

        $formatter = new IntlDateFormatter(
            'id_ID', 
            IntlDateFormatter::FULL, 
            IntlDateFormatter::NONE, 
            'Asia/Jakarta', 
            IntlDateFormatter::GREGORIAN,
            'd MMMM yyyy'
        );

        $this->data['tanggal_training'] = $formatter->format($date_object);
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
        $this->setCertificateLink($this->data['lokasi_sertifikat']);
    }
    
    public function getCertificateLink(): string
    {
        return $this->data['tautan_sertifikat'];
    }

    public function setCertificateLink(string $path): void
    {
        $certificate_filename = $this->parseFilename($path);
        $this->data['tautan_sertifikat'] = "http://localhost/certificate-generator/public/certificate/" . $certificate_filename['email'] . "/" . $certificate_filename['name'] . "/" . $certificate_filename['timestamp'];
    }

    private function parseFilename(string $filename): array
    {
        $filename_without_ext = pathinfo($filename, PATHINFO_FILENAME);
        $parts = explode('-', $filename_without_ext);
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
