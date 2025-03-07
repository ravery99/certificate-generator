<?php

namespace App\Services;

use App\Config\Config;
use App\Core\Service;
use App\Models\Participant;
use App\Models\Certificate;

use App\Generator\CertificateGenerator;

use App\Validators\ParticipantValidator;
use Exception;

class ParticipantService extends Service
{
    private Participant $participant_model;
    private Certificate $certificate_model;
    private DivisionService $division_service;
    private FacilityService $facility_service;

    public function __construct(Participant $participant_model, Certificate $certificate_model, DivisionService $division_service, FacilityService $facility_service)
    {
        parent::__construct(); 
        $this->participant_model = $participant_model;
        $this->certificate_model = $certificate_model;
        $this->division_service = $division_service;
        $this->facility_service = $facility_service;
    }

    public function store()
    {
        try {
            $data = $this->validateInput($_POST);
            $participant_data = $this->participant_model->addParticipant($data);
            $certificate_data = $this->addDivisionAndFacilityNames($participant_data);
            
            $certificate_link = $this->createCertificate($certificate_data);
            $success = $this->sendCertificateLink($participant_data, $certificate_link);
            $this->flash_service->set("success", "Peserta baru berhasil ditambahkan!");
            
        } catch (Exception $e) {
            $this->exception_handler->handle($e, 'tambah', 'peserta');
        }

        return $success ?? false;
    }

    public function destroy(string $id)
    {
        try {
            $deleted = $this->participant_model->deleteParticipant($id);
            
            $this->flash_service->set(
                $deleted ? "success" : "error",
                $deleted ? "Peserta dengan ID $id berhasil dihapus!" : "Peserta dengan ID $id sudah tidak tersedia. Silakan muat ulang halaman dan coba lagi.");

            http_response_code($deleted ? 200 : 404);
        } catch (Exception $e) { 
            $this->exception_handler->handle($e, 'hapus', 'peserta', $id);
        }

        return $deleted ?? false;
    }

    private function validateInput(array $input)
    {
        $validator = new ParticipantValidator($this->division_service, $this->facility_service);
        return $validator->validate($input);
    }


    public function getDivisions(): array
    {
        $divisions = $this->division_service->getDivisions();
        return $divisions;
    }
    
    public function getFacilities(): array
    {
        $facilities = $this->facility_service->getFacilities();
        return $facilities;
    }
    
    public function getParticipants(): array
    {
        $participants = $this->participant_model->getAllParticipants();
        $participants_data = [];
        foreach ($participants as $participant) {
            $participants_data[] = $this->addDivisionAndFacilityNames($participant);
        }        

        return $participants_data;
    }

    private function getParticipantDivisionName(string $division_id): string
    {
        $divisions = $this->division_service->getDivisions(); 
        $division_map = array_column($divisions, 'name', 'id'); 
        return $division_map[$division_id] ?? null;
    }

    private function getParticipantFacilityName(string $facility_id): string
    {
        $facilities = $this->facility_service->getFacilities();
        $facility_map = array_column($facilities, 'name', 'id'); 
        return $facility_map[$facility_id] ?? null;
    }

    private function addDivisionAndFacilityNames(array $participant_data)
    {
        $participant_division_name = $this->getParticipantDivisionName($participant_data['division_id']);
        $participant_facility_name = $this->getParticipantFacilityName($participant_data['facility_id']);

        $certificate_data = array_merge($participant_data, [
            "division_name" => $participant_division_name,
            "facility_name" => $participant_facility_name
        ]);   

        return $certificate_data;
    }
    private function createCertificate(array $participant_data): string
    {
        try {
            $certificate_generator = new CertificateGenerator($participant_data, $this->certificate_model);
            $certificate_info = $certificate_generator->generate();
    
            if (!$certificate_info || !isset($certificate_info['filename'], $certificate_info['link'])) {
                throw new Exception("Failed to generate certificate");
            }
    
            $is_saved = $this->certificate_model->addCertificate($participant_data['id'], $certificate_info['filename'], $certificate_info['link']);
            if (!$is_saved) {
                throw new Exception("Failed to save certificate");
            }
    
            return $certificate_info['link'];
        } catch (Exception $e) {
            throw new Exception("Error in createCertificate: " . $e->getMessage());
        }
    }

    private function sendCertificateLink(array $participant_data, string $certificate_link): bool
    {
        $email = $participant_data['email'];
        $name = $participant_data['p_name'];
        $link = Config::DOMAIN . Config::BASE_URL . $certificate_link;

        $subject = "Sertifikat Anda Sudah Siap!";
        $body = "Hai $name,\n\nSertifikat Anda sudah siap! Klik tautan di bawah ini untuk mengaksesnya:\n\n$link\n\nHarap segera mengunduh sertifikat Anda sebelum tautan kedaluwarsa atau sertifikat dihapus dari sistem.\n\nSalam,\nTim Trustmedis";

        $email_service = new EmailService();
        $is_sent = $email_service->sendEmail($email, $subject, $body);

        if (!$is_sent) {
            throw new Exception("Failed to send certificate link via email");
        }
        return $is_sent;
    }
}
