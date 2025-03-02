<?php

namespace App\Routes;

use App\Core\Routes;
use App\Config\Config;
use App\Controllers\FacilityController;

class FacilityRoutes extends Routes
{
    public function register(): void
    {
        $this->router->get(Config::BASE_URL . "/facilities", $this->resolve(FacilityController::class, 'index'));
        $this->router->get(Config::BASE_URL . "/facilities/create", $this->resolve(FacilityController::class, 'create'));
        $this->router->post(Config::BASE_URL . "/facilities", $this->resolve(FacilityController::class, 'store'));
        $this->router->get(Config::BASE_URL . "/facilities/{id}/edit", $this->resolve(FacilityController::class, 'edit'));
        $this->router->patch(Config::BASE_URL . "/facilities/{id}", $this->resolve(FacilityController::class, 'update'));
        $this->router->delete(Config::BASE_URL . "/facilities/{id}", $this->resolve(FacilityController::class, 'destroy'));
    }
}