<?php

namespace App\Services;

use App\Core\Service;
use App\Services\UserService;
use App\Services\ParticipantService;
use App\Services\CertificateService;
use Exception;

class DashboardService extends Service
{
    private UserService $user_service;
    private ParticipantService $participant_service;
    private CertificateService $certificate_service;

    public function __construct(UserService $user_service, ParticipantService $participant_service, CertificateService $certificate_service)
    {
        $this->user_service = $user_service;
        $this->participant_service = $participant_service;
        $this->certificate_service = $certificate_service;
    }

    public function getTotals()
    {
        $total_users = count($this->user_service->getUsers());
        $total_participants = count($this->participant_service->getParticipants());
        $total_certificates = count($this->certificate_service->getCertificates());
        $totals = [
            "total_users" => $total_users,
            "total_participants" => $total_participants,
            "total_certificates" => $total_certificates,
        ];

        return $totals;
    }

    public function getParticipants()
    {
        $participants = $this->participant_service->getParticipants();
        return $this->getAllParticipantData($participants);
    }

    public function searchParticipants(string $keyword)
    {
        $participants = $this->participant_service->searchParticipants($keyword);
        return $this->getAllParticipantData($participants);
    }

    private function getAllParticipantData(array $participants)
    {
        $participants_data = [];

        foreach ($participants as $participant) {
            $certificate = $this->certificate_service->getCertificate($participant['id']);
            if (!$certificate) {
                $certificate = [];
            }
            $participants_data[] = array_merge($participant, $certificate ?? []);
        }

        return $participants_data;
    }
}
