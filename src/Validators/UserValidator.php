<?php

namespace App\Validators;

use App\Services\FlashMessageService;
use App\Services\LogService;

class UserValidator
{
    private FlashMessageService $flash_service;

    public function __construct(FlashMessageService $flash_service)
    {
        $this->flash_service = $flash_service;
    }

    public function validate(array $input)
    {
        $is_username_valid = $this->validateUsername($input['username']);
        if (!$is_username_valid) {
            return false;
        }

        $is_password_valid = $this->validatePassword($input['password']);
        if (!$is_password_valid) {
            return false;
        }

        $is_password_confirmed = $this->isPasswordConfirmed($input['password'], $input['password_confirmation']);
        if (!$is_password_confirmed) {
            return false;
        }
        return $input;
    }

    private function validateUsername(string $username): bool
    {
        if (!preg_match('/^[a-zA-Z0-9._]{3,30}$/', $username)) {
            LogService::logError("Registration Failed :", "Username hanya boleh berisi huruf, angka, titik, atau garis bawah dan harus antara 3-30 karakter.");
            $this->flash_service->set("error", "Username hanya boleh berisi huruf, angka, titik, atau garis bawah dan harus antara 3-30 karakter.");
            return false;
        }
        // if ($this->getUserByUsername($username)) {
        //     return false;
        // }
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
}
