<?php

namespace App\Services;

use App\Models\User;
use App\Core\Service;
use Exception;

class UserService extends Service
{
    private User $user_model;

    public function __construct(User $user_model)
    {
        parent::__construct();
        $this->user_model = $user_model;
    }

    public function getUsers()
    {
        $users = $this->user_model->getAllUsers();
        return $users;
    }

    public function getUserById(string $id)
    {
        $user = $this->user_model->getUserById($id);
        return $user;
    }

    public function getUserByUsername(string $username)
    {
        $user = $this->user_model->getUserByUsername($username);
        if (!$user) {
            $this->flash_service->set("error", "Username tidak dapat ditemukan!");
            return false;
        } else {
            $this->flash_service->set("error", "User $username sudah ada.");
            http_response_code(409);
            return $user;
        }
    }

    public function search(string $keyword)
    {
        $users = $this->user_model->searchUsers($keyword);
        return $users;
    }

    public function store(): bool
    {
        try {
            $input = $this->getInput();
            $is_username_valid = $this->validateUsername($input['username']);
            $is_password_valid = $this->validatePassword($input['password']);
            $is_password_confirmed = $this->isPasswordConfirmed($input['password'], $input['password_confirmation']);

            if (!$is_username_valid || !$is_password_valid || !$is_password_confirmed) {
                return false;
            }

            $success = $this->createUser($input);
        } catch (Exception $e) {
            $this->exception_handler->handle($e, 'tambah', 'user');
        }
        return $success ?? false;
    }

    public function update(string $id)
    {
        try {
            $username = trim($_POST['username']);
            $user = $this->getUserByUsername($username);

            if ($user) {
                return false;
            }

            $success = $this->updateUser($id, $username);
        } catch (Exception $e) {
            $this->exception_handler->handle($e, 'edit', 'user', $id);
        }
        return $success ?? false;
    }

    public function destroy(string $id)
    {
        try {
            $deleted = $this->user_model->deleteUser($id);
            $this->flash_service->set(
                $deleted ? "success" : "error",
                $deleted ? "Divisi dengan ID $id berhasil dihapus!" : "Divisi dengan ID $id sudah tidak tersedia. Silakan muat ulang halaman dan coba lagi."
            );

            http_response_code($deleted ? 200 : 404);
        } catch (Exception $e) {
            $this->exception_handler->handle($e, 'hapus', 'divisi', $id);
        }
        return $deleted ?? false;
    }

    public function getInput()
    {
        $username = $_POST['username'];
        // $email = $_POST['email'];
        $password = $_POST['password'];
        $password_confirmation = $_POST['password_confirmation'];
        $input = [
            'username' => $username,
            'password' => $password,
            'password_confirmation' => $password_confirmation
        ];
        return $input;
    }

    private function isPasswordConfirmed(string $password, string $password_confirmation)
    {
        if ($password !== $password_confirmation) {
            LogService::logError("Registration Error :", "Konfirmasi kata sandi tidak cocok!");
            $this->flash_service->set("error", "Konfirmasi kata sandi tidak cocok!");
            http_response_code(400);
            return false;
        }
        return true;
    }

    private function updateUser(string $id, string $username)
    {
        $hashed_password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $success = $this->user_model->updateUser($id, $username, $hashed_password);
        $this->flash_service->set(
            $success ? "success" : "error",
            $success ? "User dengan ID $id berhasil diperbarui!" : "Gagal memperbarui user dengan ID $id. Terjadi kesalahan saat menyimpan data."
        );

        http_response_code($success ? 200 : 500);
        return $success;
    }

    private function createUser(array $input)
    {
        $hashed_password = password_hash($input['password'], PASSWORD_BCRYPT);
        $success = $this->user_model->addUser($input['username'], $hashed_password);
        $this->flash_service->set(
            $success ? "success" : "error",
            $success ? "User baru berhasil ditambahkan!" : "Gagal menambahkan user {$input['username']}. Terjadi kesalahan saat menyimpan data."
        );

        http_response_code($success ? 201 : 500);
        return $success;
    }

    private function validateUsername(string $username): bool
    {
        if (!preg_match('/^[a-zA-Z0-9._]{3,30}$/', $username)) {
            LogService::logError("Registration Failed :", "Username hanya boleh berisi huruf, angka, titik, atau garis bawah dan harus antara 3-30 karakter.");
            $this->flash_service->set("error", "Username hanya boleh berisi huruf, angka, titik, atau garis bawah dan harus antara 3-30 karakter.");
            return false;
        }
        if ($this->getUserByUsername($username)) {
            return false;
        }
        return true;
    }

    private function validatePassword(string $password): bool
    {
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/', $password)) {
            LogService::logError("Registration Failed :", "Password harus minimal 8 karakter, mengandung huruf besar, huruf kecil, dan angka.");
            $this->flash_service->set("error", "Password harus minimal 8 karakter, mengandung huruf besar, huruf kecil, dan angka.");
            return false;
        }

        return true;
    }
}
