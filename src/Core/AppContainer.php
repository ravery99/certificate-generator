<?php

declare(strict_types=1);

namespace App\Core;

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use App\Services\ParticipantService;
use App\Config\DatabaseConfig;
use App\Controllers\ParticipantController;
use App\Controllers\CertificateController;
use App\Controllers\ErrorController;

class AppContainer
{
    private ContainerInterface $container;

    public function __construct()
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions([
            ParticipantService::class => \DI\autowire(ParticipantService::class),
            DatabaseConfig::class => \DI\autowire(DatabaseConfig::class),
            ParticipantController::class => \DI\autowire(ParticipantController::class),
            CertificateController::class => \DI\autowire(CertificateController::class),
            ErrorController::class => \DI\autowire(ErrorController::class),
        ]);

        $this->container = $containerBuilder->build();
    }

    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }
}
