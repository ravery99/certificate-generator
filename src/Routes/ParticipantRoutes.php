<?php

namespace App\Routes;

use App\Core\Routes;
use App\Config\Config;
use App\Controllers\ParticipantController;

class ParticipantRoutes extends Routes
{
    public function register(): void
    {
        $this->router->get(Config::BASE_URL . "/participants", $this->resolve(ParticipantController::class, 'index'));
        $this->router->get(Config::BASE_URL . "/participants/create", $this->resolve(ParticipantController::class, 'create'));
        $this->router->post(Config::BASE_URL . "/participants", $this->resolve(ParticipantController::class, 'store'));
        $this->router->delete(Config::BASE_URL . "/participants/{id}", $this->resolve(ParticipantController::class, 'destroy'));
        $this->router->post(Config::BASE_URL . "/participants/search", $this->resolve(ParticipantController::class, 'search'));

        $this->router->get(Config::BASE_URL . "/participants/create/success", $this->resolve(ParticipantController::class, 'showSubmissionSuccess'));
        $this->router->get(Config::BASE_URL . "/participants/create/fail", $this->resolve(ParticipantController::class, 'showSubmissionFail'));
    }
}
