<?php

namespace App\Validators;

use App\Config\DatabaseConfig;
use App\Services\DivisionService;
use App\Services\FacilityService;
use Dotenv\Exception\ValidationException;
use DateTime;

class ParticipantValidator
{
    private DivisionService $division_service;
    private FacilityService $facility_service;

    public function __construct(DivisionService $division_service, FacilityService $facility_service)
    {
        $this->division_service = $division_service;
        $this->facility_service = $facility_service;
    }

    public function validate(array $input): array
    {
        $filtered_data = [
            'email'         => $this->validateEmail($input['email'] ?? ''),
            'training_date' => $this->validateTrainingDate($input['training_date'] ?? ''),
            'p_name'        => $this->validateName($input['p_name'] ?? ''),
            'division_id'      => $this->validateDivisionId($input['division_id'] ?? ''),
            'facility_id'      => $this->validateFacilityId($input['facility_id'] ?? ''),
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

    private function validateDivisionId($division_id): ?string
    {
        $division_ids = array_column($this->division_service->getDivisions(), 'id');
        return in_array((int) $division_id, $division_ids, true) ? $division_id : null;
    }

    private function validateFacilityId($facility_id): ?string
    {
        $facility_ids = array_column($this->facility_service->getFacilities(), 'id'); 
        return in_array((int) $facility_id, $facility_ids, true) ? $facility_id : null;
    }

    private function validatePhoneNumber($phone): ?string
    {
        return preg_match('/^\d{10,15}$/', $phone) ? $phone : null;
    }
}