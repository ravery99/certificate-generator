<?php

namespace App\Routes;

use App\Core\Routes;
use App\Config\Config;
use App\Controllers\DivisionController;

class DivisionRoutes extends Routes
{
    public function register(): void
    {
        $this->router->get(Config::BASE_URL . "/divisions", $this->resolve(DivisionController::class, 'index'));
        $this->router->get(Config::BASE_URL . "/divisions/create", $this->resolve(DivisionController::class, 'create'));
        $this->router->post(Config::BASE_URL . "/divisions", $this->resolve(DivisionController::class, 'store'));
        $this->router->get(Config::BASE_URL . "/divisions/{id}/edit", $this->resolve(DivisionController::class, 'edit'));
        $this->router->patch(Config::BASE_URL . "/divisions/{id}", $this->resolve(DivisionController::class, 'update'));
        $this->router->delete(Config::BASE_URL . "/divisions/{id}", $this->resolve(DivisionController::class, 'destroy'));
    }
}
