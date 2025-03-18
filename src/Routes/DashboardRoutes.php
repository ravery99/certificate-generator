<?php

namespace App\Routes;

use App\Core\Routes;
use App\Config\Config;
use App\Controllers\DashboardController;

class DashboardRoutes extends Routes
{
    public function register(): void
    {
        $this->router->get(Config::BASE_URL . "/dashboard", $this->resolve(DashboardController::class, 'index'));
    }
}
