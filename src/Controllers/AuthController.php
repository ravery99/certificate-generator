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
        if($this->auth_service->login()){
            $this->redirect('dashboard');        
        } else {
            $this->redirect('login');        
        }
    }

    public function logout()
    {
        $this->auth_service->logout();
        $this->redirect('login');
    }

    public function register()
    {
        if($this->auth_service->register()){
            $this->redirect('login');        
        } else {
            $this->redirect('register');        
        }
    }

    public function showLoginForm()
    {
        $this->renderView("auth/login", "layouts/main", [
            "page_title" => "Login Admin",
        ]); //layout_path nya benerin lagi

    }

    public function showRegisterForm()
    {
        $this->renderView("auth/register", "layouts/main", [
            "page_title" => "Register Admin",
        ]); //layout_path nya benerin lagi
    }

    public function dashboard()
    {
        $this->renderView("dashboard", "layouts/main", [
            "page_title" => "Dashboard",
        ]); //layout_path nya benerin lagi
    }

    protected function redirect(string|null $url = null)
    {
        header("Location: " . Config::BASE_URL . "/$url", true, 303);
        exit;
    }
}