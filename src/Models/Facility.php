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

    public function getAllFacilities(): array|bool
    {
        $this->db->query("SELECT * FROM facilities ORDER BY name ASC");
        return $this->db->results();
    }

    public function getFacilityById(string $id): array|bool
    {
        $this->db->query("SELECT * FROM facilities WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->result();
    }

    public function getFacilityByName(string $name): array|bool
    {
        $this->db->query("SELECT * FROM facilities WHERE name = :name");
        $this->db->bind(':name', $name);
        return $this->db->result();
    }

    public function addFacility(string $name): bool
    {
        $this->db->query("INSERT INTO facilities (name) VALUES (:name)");
        $this->db->bind(':name', $name);
        return $this->db->rowCount() > 0;
    }

    public function updateFacility(string $id, string $name): bool
    {
        $this->db->query("UPDATE facilities SET name = :name, updated_at = CURRENT_TIMESTAMP WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->bind(':name', $name);
        return $this->db->rowCount() > 0;
    }

    public function deleteFacility(string $id): bool
    {
        $this->db->query("DELETE FROM facilities WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->rowCount() > 0;
    }

    public function searchFacilities(string $keyword): array|bool
    {
        $this->db->query("SELECT * FROM facilities WHERE 
                            id::TEXT ILIKE :keyword OR 
                            name ILIKE :keyword");
        $this->db->bind(':keyword', "%$keyword%");
        return $this->db->results();
    }
}
