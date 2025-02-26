<?php

namespace App\Models;

use App\Config\Database;
use App\Services\EmailService;
use Ramsey\Uuid\Uuid;
use App\Config\Config;

class ParticipantBaru
{
    // email, training_date, p_name, division, facility, phone_number, certificate_path, certificate_link
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

	public function getParticipant(string $id): array
    {
        $this->db->query("SELECT * FROM tb_participant WHERE id=:id");
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->result();
    }

    public function addParticipant(array $data)
    {
        $uuid = Uuid::uuid4()->toString();

        $this->db->query(
            "INSERT INTO tb_participant (id, email, training_date, p_name, division, facility, phone_number)
                  VALUES (:id, :email, :training_date, :p_name, :division, :facility, :phone_number)"
        );

        $this->db->bind(':id', $uuid);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':training_date', $data['training_date']);
        $this->db->bind(':p_name', $data['p_name']);
        $this->db->bind(':division', $data['division']);
        $this->db->bind(':facility', $data['facility']);
        $this->db->bind(':phone_number', $data['phone_number']);
        $this->db->execute();

        $this->setCertificatePath($uuid);
        $this->sendCertificateLink($uuid);

    }

    private function setCertificatePath(string $id)
    {
        $participant = $this->getParticipant($id);
        if (!$participant) {
            throw new \Exception("Participant not found.");
        }

        $certificate = new CertificateBaru($participant);
        $certificatePath = $certificate->generate();

        $this->db->query("UPDATE tb_participant SET certificate_path = :certificate_path WHERE id = :id");
        $this->db->bind(':certificate_path', $certificatePath);
        $this->db->bind(':id', $id);
        $this->db->execute();
    }

    private function sendCertificateLink(string $id)
    {
        $participant = $this->getParticipant($id);
        if (!$participant || empty($participant['certificate_path'])) {
            throw new \Exception("Participant not found or certificate not generated.");
        }

        $email = $participant['email'];
        $name = $participant['p_name'];
        $certificate_link = Config::BASE_URL . "/certificates/" . basename($participant['certificate_path']);

        $subject = "Your Certificate is Ready!";
        $body = "Hi $name,\n\nYour certificate is ready! Click the link below to access it:\n\n$certificate_link\n\nBest regards,\nYour Team";

        // Gunakan EmailService untuk mengirim email
        $email_service = new EmailService();
        $email_service->sendEmail($email, $subject, $body);
    }
}
