<?php

namespace App\Models;

use App\Config\DatabaseConfig;

class Division
{
    private DatabaseConfig $db;

    public function __construct(DatabaseConfig $db)
    {
        $this->db = $db;
    }

    public function getAllDivisions(): array|bool
    {
        $this->db->query("SELECT * FROM divisions ORDER BY name ASC");
        return $this->db->results();
    }

    public function getDivisionById(string $id): array|bool
    {
        $this->db->query("SELECT * FROM divisions WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->result();
    }

    public function getDivisionByName(string $name): array|bool
    {
        $this->db->query("SELECT * FROM divisions WHERE name = :name");
        $this->db->bind(':name', $name);
        return $this->db->result();
    }

    public function addDivision(string $name): bool
    {
        $this->db->query("INSERT INTO divisions (name) VALUES (:name)");
        $this->db->bind(':name', $name);
        return $this->db->rowCount() > 0;
    }

    public function updateDivision(string $id, string $name): bool
    {
        $this->db->query("UPDATE divisions SET name = :name, updated_at = CURRENT_TIMESTAMP WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->bind(':name', $name);
        return $this->db->rowCount() > 0;
    }

    public function deleteDivision(string $id): bool
    {
        $this->db->query("DELETE FROM divisions WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->rowCount() > 0;
    }

    public function searchDivisions(string $keyword): array|bool
    {
        $this->db->query("SELECT * FROM divisions WHERE 
                            id::TEXT ILIKE :keyword OR 
                            name ILIKE :keyword");
        $this->db->bind(':keyword', "%$keyword%");
        return $this->db->results();
    }
}
