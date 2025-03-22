<?php

namespace App\Routes;

use App\Core\Routes;
use App\Config\Config;
use App\Controllers\UserController;

class UserRoutes extends Routes
{
    public function register(): void
    {
        $this->router->get(Config::BASE_URL . "/users", $this->resolve(UserController::class, 'index'));
        $this->router->get(Config::BASE_URL . "/users/create", $this->resolve(UserController::class, 'create'));
        $this->router->post(Config::BASE_URL . "/users", $this->resolve(UserController::class, 'store'));
        $this->router->get(Config::BASE_URL . "/users/{id}/edit", $this->resolve(UserController::class, 'edit'));
        $this->router->patch(Config::BASE_URL . "/users/{id}", $this->resolve(UserController::class, 'update'));
        $this->router->delete(Config::BASE_URL . "/users/{id}", $this->resolve(UserController::class, 'destroy'));
        $this->router->post(Config::BASE_URL . "/users/search", $this->resolve(UserController::class, 'search'));
    }
}
