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
        $date_object = new DateTime($this->training_date);

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
    public function getCertificate(): string 
    {
        return $this->data['lokasi_sertifikat'];
    }
    
    public function setCertificate(): void 
    {
        $certificate = new Certificate($this);
        $this->data['lokasi_sertifikat'] = $certificate->generate();
    }
    

}
