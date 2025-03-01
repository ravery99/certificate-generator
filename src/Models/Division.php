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

    public function getAllDivisions(): array
    {
        $this->db->query("SELECT * FROM divisions ORDER BY name ASC");
        $this->db->execute();
        return $this->db->results();
    }

    public function getDivisionById(string $id): array
    {
        $this->db->query("SELECT * FROM divisions WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->result();
    }

    public function addDivision(string $name): bool
    {
        $this->db->query("INSERT INTO divisions (name) VALUES (:name)");
        $this->db->bind(':name', $name);
        $this->db->execute();
        return $this->db->rowCount() > 0;
    }

    public function updateDivision(string $id, string $name): bool
    {
        $this->db->query("UPDATE divisions SET name = :name, updated_at = CURRENT_TIMESTAMP WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->bind(':name', $name);
        $this->db->execute();
        return $this->db->rowCount() > 0;
    }

    public function deleteDivision(string $id): bool
    {
        $this->db->query("DELETE FROM divisions WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowCount() > 0;
    }
}
