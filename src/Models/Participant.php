<?php

namespace App\Models;

use DateTime;
use IntlDateFormatter;


class Participant
{
	private string $timestamp;
    private string $email;
    private string $training_date;
    private string $name;
    private string $division;
    private string $facility;
    private string $phone_number;

    public function __construct( $timestamp,  $email,  $training_date,  $name,  $division,  $facility,  $phone_number)
    {
        $this->timestamp = $timestamp;
        $this->email = $email;
        $this->training_date = $training_date;
        $this->name = $name;
        $this->division = $division;
        $this->facility = $facility;
        $this->phone_number = $phone_number;

        $this->formatTrainingDateToLocale();
    }
	public function getTimestamp(): string {return $this->timestamp;}

	public function getEmail(): string {return $this->email;}

	public function getTrainingDate(): string {return $this->training_date;}

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

	public function getName(): string {return $this->name;}

	public function getDivision(): string {return $this->division;}

	public function getFacility(): string {return $this->facility;}

	public function getPhoneNumber(): string {return $this->phone_number;}

}
