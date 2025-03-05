<?php

namespace App\Services;

use App\Config\DatabaseConfig;
use App\Config\Config;
use App\Models\Participant;
use App\Models\Certificate;
use App\Models\Division;
use App\Models\Facility;

use App\Generator\CertificateGenerator;
use Exception;
use Dotenv\Exception\ValidationException;
use DateTime;

class ParticipantService {
    
    public function getDivisions(DatabaseConfig $db): array
    {
        $division_model = new Division($db);
        return $division_model->getAllDivisions();
    }

    public function getFacilities(DatabaseConfig $db): array
    {
        $facility_model = new Facility($db);
        return $facility_model->getAllFacilities();
    }

    public function getParticipants(DatabaseConfig $db): array
    {
        $participant_model = new Participant($db);
        return $participant_model->getAllParticipants();
    }

    public function deleteParticipant(DatabaseConfig $db, string $id): bool
    {
        $participant_model = new Participant($db);
        return $participant_model->deleteParticipant($id);
    }

    public function getParticipantDivisionName(DatabaseConfig $db, string $division_id): string
    {
        $divisions = $this->getDivisions($db); 
        $division_map = array_column($divisions, 'name', 'id'); 
        return $division_map[$division_id] ?? null;
    }

    public function getParticipantFacilityName(DatabaseConfig $db, string $facility_id): string
    {
        $facilities = $this->getFacilities($db);
        $facility_map = array_column($facilities, 'name', 'id'); 
        return $facility_map[$facility_id] ?? null;
    }

    public function validateInput(DatabaseConfig $db, array $input): array
    {
        $filtered_data = [
            'email'         => $this->validateEmail($input['email'] ?? ''),
            'training_date' => $this->validateTrainingDate($input['training_date'] ?? ''),
            'p_name'        => $this->validateName($input['p_name'] ?? ''),
            'division_id'      => $this->validateDivisionId($db, $input['division_id'] ?? ''),
            'facility_id'      => $this->validateFacilityId($db, $input['facility_id'] ?? ''),
            'phone_number'  => $this->validatePhoneNumber($input['phone_number'] ?? '')
        ];
        
        $this->checkRequiredFields($filtered_data);
        return $filtered_data;
    }

    private function checkRequiredFields($data): void
    {
        $required_fields = ['email', 'training_date', 'p_name', 'division_id', 'facility_id'];
        foreach ($required_fields as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                throw new ValidationException("Field '{$field}' is required but missing or empty or invalid. Field '{$field}' : $data[$field]");
            }
        }
    }
    
    private function validateEmail($email): ?string
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) ?: null;
    }

    private function validateTrainingDate($date): ?string
    {
        return DateTime::createFromFormat('Y-m-d', $date) !== false ? $date : null;
    }

    private function validateName($name): ?string
    {
        return preg_match('/^[a-zA-Z\s]+$/', trim($name)) ? trim($name) : null;
    }

    private function validateDivisionId(DatabaseConfig $db, $division_id): ?string
    {
        $division_ids = array_column($this->getDivisions($db), 'id');
        return in_array((int) $division_id, $division_ids, true) ? $division_id : null;
    }

    private function validateFacilityId(DatabaseConfig $db, $facility_id): ?string
    {
        $facility_ids = array_column($this->getFacilities($db), 'id'); 
        return in_array((int) $facility_id, $facility_ids, true) ? $facility_id : null;
    }

    private function validatePhoneNumber($phone): ?string
    {
        return preg_match('/^\d{10,15}$/', $phone) ? $phone : null;
    }

    public function createParticipant(DatabaseConfig $db, array $validated_input): array
    {
        try {
            $participant_model = new Participant($db);
            $participant_data = $participant_model->addParticipant($validated_input);

            if (!$participant_data) {
                throw new Exception("Failed to save participant data");
            }
    
            return $participant_data;
        } catch (Exception $e) {
            throw new Exception("Error in createParticipant: " . $e->getMessage());
        }
    }

    public function createCertificate(DatabaseConfig $db, array $participant_data): string
    {
        try {
            $certificate_model = new Certificate($db);
            $certificate_generator = new CertificateGenerator($participant_data);
            $certificate_info = $certificate_generator->generate();
    
            if (!$certificate_info || !isset($certificate_info['filename'], $certificate_info['link'])) {
                throw new Exception("Failed to generate certificate");
            }
    
            $is_saved = $certificate_model->addCertificate($participant_data['id'], $certificate_info['filename'], $certificate_info['link']);
            if (!$is_saved) {
                throw new Exception("Failed to save certificate");
            }
    
            return $certificate_info['link'];
        } catch (Exception $e) {
            throw new Exception("Error in createCertificate: " . $e->getMessage());
        }
    }

    public function sendCertificateLink(array $participant_data, string $certificate_link)
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
    }
}
