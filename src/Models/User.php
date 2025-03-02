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

    public function getAllUsers(): array
    {
        $this->db->query("SELECT id, username, created_at FROM users ORDER BY username ASC");
        $this->db->execute();
        return $this->db->results();
    }

    public function getUserById(string $id): array
    {
        $this->db->query("SELECT id, username, created_at FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->result();
    }

    public function getUserByUsername(string $username): array
    {
        $this->db->query("SELECT * FROM users WHERE username = :username");
        $this->db->bind(':username', $username);
        $this->db->execute();
        return $this->db->result();
    }

    public function addUser(string $username, string $password): bool
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $this->db->query("INSERT INTO users (username, password) VALUES (:username, :password)");
        $this->db->bind(':username', $username);
        $this->db->bind(':password', $hashedPassword);
        $this->db->execute();
        return $this->db->rowCount() > 0;
    }

    public function updateUser(string $id, string $username, string $password): bool
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $this->db->query("UPDATE users SET username = :username, password = :password, updated_at = CURRENT_TIMESTAMP WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->bind(':username', $username);
        $this->db->bind(':password', $hashedPassword);
        $this->db->execute();
        return $this->db->rowCount() > 0;
    }

    public function deleteUser(string $id): bool
    {
        $this->db->query("DELETE FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowCount() > 0;
    }
}
