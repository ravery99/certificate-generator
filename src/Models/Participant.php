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

    public function getAllParticipants(): array|bool
    {
        $this->db->query("SELECT * FROM participants ORDER BY created_at DESC");
        return $this->db->results();
    }

    public function getParticipantById(string $id): array|bool
    {
        $this->db->query("SELECT * FROM participants WHERE id=:id");
        $this->db->bind(':id', $id);
        return $this->db->result();
    }

    public function getParticipantByEmail(string $email): array|bool
    {
        $this->db->query("SELECT * FROM participants WHERE email=:email");
        $this->db->bind(':email', $email);
        return $this->db->result();
    }

    public function searchParticipants(string $keyword): array|bool
    {
        $this->db->query("SELECT * FROM participants WHERE 
                            id::TEXT ILIKE :keyword OR 
                            p_name ILIKE :keyword OR 
                            email ILIKE :keyword OR
                            phone_number ILIKE :keyword");
        $this->db->bind(':keyword', "%$keyword%");
        return $this->db->results();
    }

    public function addParticipant(array $data): ?array
    {
        $this->db->query(
            "INSERT INTO participants (id, email, training_date, p_name, division_id, facility_id, phone_number)
                  VALUES (gen_random_uuid(), :email, :training_date, :p_name, :division_id, :facility_id, :phone_number)
                  RETURNING *"
        );

        $this->db->bind(':email', $data['email']);
        $this->db->bind(':training_date', $data['training_date']);
        $this->db->bind(':p_name', $data['p_name']);
        $this->db->bind(':division_id', $data['division_id']);
        $this->db->bind(':facility_id', $data['facility_id']);
        $this->db->bind(':phone_number', $data['phone_number']);
        $result = $this->db->result();
        return $result ?? null;
    }

    public function updateParticipant(array $data): bool
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
        return $this->db->rowCount() > 0;
    }

    public function deleteParticipant(string $id): bool
    {
        $this->db->query("DELETE FROM participants WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->rowCount() > 0;
    }
}
