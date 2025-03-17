<?php

namespace App\Services;

use App\Core\Service;
use App\Services\UserService;
use App\Services\ParticipantService;
use App\Services\CertificateService;

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

    public function getData()
    {
        $total_users = count($this->user_service->getUsers());
        $total_participants = count($this->participant_service->getParticipants());
        $total_certificates = count($this->certificate_service->getCertificates());
        $data = [
            "total_users" => $total_users,
            "total_participants" => $total_participants,
            "total_certificates" => $total_certificates,
        ];

        // $data = [$total_users, $total_participants, $total_certificates];

        return $data;
    }

    
}
