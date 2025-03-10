<?php

namespace App\Models;

use App\Config\DatabaseConfig;

class Certificate
{
    private DatabaseConfig $db;

    public function __construct(DatabaseConfig $db)
    {
        $this->db = $db;
    }

    public function getAllCertificates(): array
    {
        $this->db->query("SELECT * FROM certificates ORDER BY created_at DESC");
        return $this->db->results();
    }

    public function getCertificateById(string $participant_id): array
    {
        $this->db->query("SELECT * FROM certificates WHERE participant_id=:participant_id");
        $this->db->bind(':participant_id', $participant_id);
        return $this->db->result();
    }

    public function addCertificate(string $participant_id, string $certificate_filename, string $certificate_link): bool
    {
        $this->db->query(
            "INSERT INTO certificates (participant_id, certificate_filename, certificate_link)
                  VALUES (:participant_id, :certificate_filename, :certificate_link)"
        );
        $this->db->bind(':participant_id', $participant_id);
        $this->db->bind(':certificate_filename', $certificate_filename);
        $this->db->bind(':certificate_link', $certificate_link);
        return $this->db->rowCount() > 0;
    }

    public function deleteCertificate(string $participant_id): bool
    {
        $this->db->query("DELETE FROM certificates WHERE participant_id = :participant_id");
        $this->db->bind(':participant_id', $participant_id);
        return $this->db->rowCount() > 0;
    }

}