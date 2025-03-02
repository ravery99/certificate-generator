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
        // return Config::DIVISIONS;
        $division_model = new Division($db);
        return $division_model->getAllDivisions();
    }

    public function getFacilities(DatabaseConfig $db): array
    {
        // return Config::FACILITIES;
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

    public function validateInput(DatabaseConfig $db, array $input): array
    {
        $filtered_data = [
            'email'         => $this->validateEmail($input['email'] ?? ''),
            'training_date' => $this->validateTrainingDate($input['training_date'] ?? ''),
            'p_name'        => $this->validateName($input['p_name'] ?? ''),
            'division_id'      => $this->validateDivisionId($db, $input['division_id'] ?? ''),
            'facility_id'      => $this->validateFacilityId(db, $input['facility_id'] ?? ''),
            'phone_number'  => $this->validatePhoneNumber($input['phone_number'] ?? '')
        ];

        $this->checkRequiredFields($filtered_data);
        return $filtered_data;
    }

    private function checkRequiredFields($data): void
    {
        $required_fields = ['email', 'training_date', 'p_name', 'division', 'facility'];
        foreach ($required_fields as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                throw new ValidationException("Field '{$field}' is required but missing or empty or invalid.");
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
        return in_array($division_id, $this->getDivisions($db), true) ? $division_id : null;
    }

    private function validateFacilityId(DatabaseConfig $db, $facility_id): ?string
    {
        return in_array($facility_id, $this->getFacilities($db), true) ? $facility_id : null;
    }

    private function validatePhoneNumber($phone): ?string
    {
        return preg_match('/^\d{10,15}$/', $phone) ? $phone : null;
    }

    public function createParticipant(DatabaseConfig $db, array $validated_input): array
    {
        // $participant_model = new Participant($db);
        // $participant_model->addParticipant($validated_input);
        // $participant_id = $participant_model->addParticipant($validated_input);
        // $participant_data = $participant_model->getParticipant($participant_id); 
        // return $participant_data;

        try {
            $participant_model = new Participant($db);
            $participant_id = $participant_model->addParticipant($validated_input);
    
            if (!$participant_id) {
                throw new Exception("Failed to save participant data");
            }
    
            $participant_data = $participant_model->getParticipantById($participant_id);
            if (!$participant_data) {
                throw new Exception("Failed to retrieve participant data");
            }
    
            return $participant_data;
        } catch (Exception $e) {
            // throw new Exception("Error in createParticipant: " . $e->getMessage());
            throw $e;
        }
    }

    public function createCertificate(DatabaseConfig $db, array $participant_data): string
    {
        // $certificate_model = new Certificate($db);
        // $certificate_generator = new CertificateGenerator($participant_data);
        // $certificate_info = $certificate_generator->generate();
        // $certificate_model->addCertificate($participant_data['id'], $certificate_info['filename'], $certificate_info['link']);
        // return $certificate_info['link'];

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

        $subject = "Sertifikat Anda Sudah Siap!";
        $body = "Hai $name,\n\nSertifikat Anda sudah siap! Klik tautan di bawah ini untuk mengaksesnya:\n\n$certificate_link\n\nHarap segera mengunduh sertifikat Anda sebelum tautan kedaluwarsa atau sertifikat dihapus dari sistem.\n\nSalam,\nTim Trustmedis";

        $email_service = new EmailService();
        $is_sent = $email_service->sendEmail($email, $subject, $body);

        if (!$is_sent) {
            throw new Exception("Failed to send certificate email");
        }
    }
}
