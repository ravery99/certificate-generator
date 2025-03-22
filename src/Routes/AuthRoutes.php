<?php

namespace App\Routes;

use App\Core\Routes;
use App\Config\Config;
use App\Controllers\AuthController;

class AuthRoutes extends Routes
{
    public function register(): void
    {
        $this->router->get(Config::BASE_URL . "/login", $this->resolve(AuthController::class, 'showLoginForm'));
        $this->router->get(Config::BASE_URL . "/register", $this->resolve(AuthController::class, 'showRegisterForm'));
        $this->router->post(Config::BASE_URL . "/login", $this->resolve(AuthController::class, 'login'));
        $this->router->post(Config::BASE_URL . "/register", $this->resolve(AuthController::class, 'register'));
        $this->router->get(Config::BASE_URL . "/logout", $this->resolve(AuthController::class, 'logout'));
    }
}
