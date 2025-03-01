<?php

namespace App\Models;

use App\Config\DatabaseConfig;
use App\Services\EmailService;
use Ramsey\Uuid\Uuid;
use App\Config\Config;
use App\Generator\CertificateBaru;

class Participant
{
    private DatabaseConfig $db;

    public function __construct(DatabaseConfig $db)
    {
        $this->db = $db;
    }

    public function getAllParticipants(): array
    {
        $this->db->query("SELECT * FROM participants ORDER BY created_at DESC");
        $this->db->execute();
        return $this->db->results();
    }

	public function getParticipantById(string $id): array
    {
        $this->db->query("SELECT * FROM participants WHERE id=:id");
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->result();
    }

    public function getParticipantByEmail(string $email): array
    {
        $this->db->query("SELECT * FROM participants WHERE email=:email");
        $this->db->bind(':email', $email);
        $this->db->execute();
        return $this->db->result();
    }

    public function addParticipant(array $data): ?string
    {
        // $uuid = Uuid::uuid4()->toString();

        $this->db->query(
            "INSERT INTO participants (id, email, training_date, p_name, division_id, facility_id, phone_number)
                  VALUES (gen_random_uuid(), :email, :training_date, :p_name, :division_id, :facility_id, :phone_number)
                  RETURNING id"
        );

        // $this->db->bind(':id', $uuid);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':training_date', $data['training_date']);
        $this->db->bind(':p_name', $data['p_name']);
        $this->db->bind(':division_id', $data['division_id']);
        $this->db->bind(':facility_id', $data['facility_id']);
        $this->db->bind(':phone_number', $data['phone_number']);
        $this->db->execute();

        $result = $this->db->result();
        return $result['id'] ?? null;
        // return $uuid;
        // $this->setCertificatePath($uuid);
        // $this->sendCertificateLink($uuid);

    }

    public function updateParticipant(array $data)
    {
        $this->db->query(
            "UPDATE participants SET email = :email, training_date = :training_date, p_name = :p_name, 
             division_id = :division_id, facility_id = :facility_id, phone_number = :phone_number 
             WHERE id = :id"
        );

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':training_date', $data['training_date']);
        $this->db->bind(':p_name', $data['p_name']);
        $this->db->bind(':division_id', $data['division_id']);
        $this->db->bind(':facility_id', $data['facility_id']);
        $this->db->bind(':phone_number', $data['phone_number']);
        $this->db->execute();

        return $this->db->rowCount() > 0;
    }

    public function deleteParticipant(string $id): bool
    {
        $this->db->query("DELETE FROM participants WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowCount() > 0;
    }

    // private function setCertificatePath(string $id)
    // {
    //     $participant = $this->getParticipant($id);
    //     if (!$participant) {
    //         throw new \Exception("Participant not found.");
    //     }

    //     $certificate = new CertificateBaru($participant);
    //     $certificatePath = $certificate->generate();

    //     $this->db->query("UPDATE participants SET certificate_filename = :certificate_filename WHERE id = :id");
    //     $this->db->bind(':certificate_filename', $certificatePath);
    //     $this->db->bind(':id', $id);
    //     $this->db->execute();
    // }

    // private function sendCertificateLink(string $id)
    // {
    //     $participant = $this->getParticipant($id);
    //     if (!$participant || empty($participant['certificate_filename'])) {
    //         throw new \Exception("Participant not found or certificate not generated.");
    //     }

    //     $email = $participant['email'];
    //     $name = $participant['p_name'];
    //     $certificate_link = Config::BASE_URL . "/certificates/" . basename($participant['certificate_filename']);

    //     $subject = "Sertifikat Anda Sudah Siap!";
    //     $body = "Hai $name,\n\nSertifikat Anda sudah siap! Klik tautan di bawah ini untuk mengaksesnya:\n\n$certificate_link\n\nHarap segera mengunduh sertifikat Anda sebelum tautan kedaluwarsa atau sertifikat dihapus dari sistem.\n\nSalam,\nTim Trustmedis";

    //     // Gunakan EmailService untuk mengirim email
    //     $email_service = new EmailService();
    //     $email_service->sendEmail($email, $subject, $body);
    // }
}
