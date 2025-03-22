<?php

namespace App\Services;

use Exception;
use App\Core\Service;
use App\Config\Config;
use App\Services\UserService;

class AuthService extends Service
{
    private UserService $user_service;

    public function __construct(UserService $user_service)
    {
        parent::__construct();
        $this->user_service = $user_service;
    }

    public function logout()
    {
        $_SESSION = [];
        session_unset();
        session_destroy();
        $this->flash_service->set("success", "Anda berhasil logout.");
    }

    public function login()
    {
        try {
            $input = $this->user_service->getInput();
            $user = $this->user_service->getUserByUsername($input['username']);
            $is_password_valid = password_verify($input['password'], $user['password']);
            if ($user && $is_password_valid) {
                session_regenerate_id(true);

                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    // 'role' => $user['role'] 
                ];
                return true;
            } else {
                $this->flash_service->set("error", "Username atau kata sandi salah!");
                return false;
            }
        } catch (Exception $e) {
            LogService::logError("Login Error :", $e->getMessage());
            $this->flash_service->set("error", "Terjadi kesalahan sistem. Silakan coba lagi nanti.");
            return false;
        }
    }


    public function register()
    {
        try {
            $success = $this->user_service->store();
            $this->flash_service->set(
                $success ? "success" : "error",
                $success ? "Registrasi berhasil! Silakan login." : "Registrasi gagal! Username mungkin sudah terpakai."
            );
            LogService::logError("Registration Succeed :", "this is register() function in AuthService class. Value of success is $success.");
        } catch (Exception $e) {
            LogService::logError("Registration Error :", $e->getMessage());
            $this->flash_service->set("error", "Terjadi kesalahan sistem. Silakan coba lagi nanti.");
        }
        return $success ?? false;
    }

    public static function check()
    {
        // if (session_status() === PHP_SESSION_NONE) {
        //     session_start();
        // }
        if (!isset($_SESSION['user'])) {
            header("Location: " . Config::BASE_URL . "/login");
            exit();
        }
    }
}
