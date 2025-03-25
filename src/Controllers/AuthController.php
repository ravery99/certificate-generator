<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Config\Config;
use App\Services\AuthService;

class AuthController extends Controller
{
    private AuthService $auth_service;

    public function __construct(AuthService $auth_service)
    {
        $this->auth_service = $auth_service;
    }

    public function login()
    {
        if ($this->auth_service->login()) {
            $this->redirect('dashboard');
        } else {
            $this->redirect('login');
        }
    }

    public function logout()
    {
        $this->renderView('partials/logout_modal', 'layouts/base', []);

        // $this->auth_service->logout();
        // $this->redirect('login');
    }

    public function register()
    {
        if ($this->auth_service->register()) {
            $this->redirect('login');
        } else {
            $this->redirect('register');
        }
    }

    public function showLoginForm()
    {
        if (isset($_SESSION['user'])) {
            $this->redirect('dashboard');
        }
        ;

        $this->renderView("auth/login", "layouts/base", [
            "page_title" => "Form Masuk Admin",
        ]);
    }

    public function showRegisterForm()
    {
        if (isset($_SESSION['user'])) {
            $this->redirect('dashboard');
        }
        ;

        $this->renderView("auth/register", "layouts/base", [
            "page_title" => "Form Pendaftaran Admin",
        ]);
    }

    protected function redirect(string|null $url = null)
    {
        header("Location: " . Config::BASE_URL . "/$url", true, 303);
        exit;
    }
}
