<?php

namespace App\Models;

use App\Config\DatabaseConfig;

class Facility
{
    private DatabaseConfig $db;

    public function __construct(DatabaseConfig $db)
    {
        $this->db = $db;
    }

    public function getAllFacilities(): array
    {
        $this->db->query("SELECT * FROM facilities ORDER BY name ASC");
        $this->db->execute();
        return $this->db->results();
    }

    public function getFacilityById(string $id): array
    {
        $this->db->query("SELECT * FROM facilities WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->result();
    }

    public function addFacility(string $name): bool
    {
        $this->db->query("INSERT INTO facilities (name) VALUES (:name)");
        $this->db->bind(':name', $name);
        $this->db->execute();
        return $this->db->rowCount() > 0;
    }

    public function updateFacility(string $id, string $name): bool
    {
        $this->db->query("UPDATE facilities SET name = :name, updated_at = CURRENT_TIMESTAMP WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->bind(':name', $name);
        $this->db->execute();
        return $this->db->rowCount() > 0;
    }

    public function deleteFacility(string $id): bool
    {
        $this->db->query("DELETE FROM facilities WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowCount() > 0;
    }
}
