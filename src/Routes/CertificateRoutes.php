<?php

namespace App\Routes;

use App\Core\Routes;
use App\Config\Config;
use App\Controllers\CertificateController;

class CertificateRoutes extends Routes
{
    public function register(): void
    {
        $this->router->get(Config::BASE_URL . "/certificates", $this->resolve(CertificateController::class, 'index'));
        $this->router->get(Config::BASE_URL . "/certificates/{id}", $this->resolve(CertificateController::class, 'show'));
        $this->router->get(Config::BASE_URL . "/certificates/{id}/download", $this->resolve(CertificateController::class, 'download'));
        $this->router->delete(Config::BASE_URL . "/certificates/{id}", $this->resolve(CertificateController::class, 'destroy'));
    }
}
