<?php

namespace App\Models;

use App\Config\DatabaseConfig;

class User
{
    private DatabaseConfig $db;

    public function __construct(DatabaseConfig $db)
    {
        $this->db = $db;
    }

    public function getAllUsers(): array|bool
    {
        $this->db->query("SELECT * FROM users ORDER BY username ASC");
        return $this->db->results();
    }


    public function getUserById(string $id): array|bool
    {
        $this->db->query("SELECT * FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->result();
    }

    public function getUserByUsername(string $username): array|bool
    {
        $this->db->query("SELECT * FROM users WHERE username = :username");
        $this->db->bind(':username', $username);
        return $this->db->result();
    }

    public function searchUsers(string $keyword): array|bool
    {
        $this->db->query("SELECT * FROM users WHERE id::TEXT ILIKE :keyword OR username ILIKE :keyword");
        $this->db->bind(':keyword', "%$keyword%");
        return $this->db->results();
    }

    public function addUser(string $username, string $password): bool
    {
        $this->db->query("INSERT INTO users (username, password) VALUES (:username, :password)");
        $this->db->bind(':username', $username);
        $this->db->bind(':password', $password);
        return $this->db->rowCount() > 0;
    }

    public function updateUser(string $id, string $username, string $password): bool
    {
        $this->db->query("UPDATE users SET username = :username, password = :password, updated_at = CURRENT_TIMESTAMP WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->bind(':username', $username);
        $this->db->bind(':password', $password);
        return $this->db->rowCount() > 0;
    }

    public function deleteUser(string $id): bool
    {
        $this->db->query("DELETE FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->rowCount() > 0;
    }
}
