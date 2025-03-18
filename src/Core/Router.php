<?php

declare(strict_types=1);

namespace App\Core;

use App\Controllers\ErrorController;
use App\Controllers\UserController;
use App\Routes\DivisionRoutes;
use App\Routes\FacilityRoutes;
use App\Routes\UserRoutes;
use Psr\Container\ContainerInterface;
use App\Routes\CertificateRoutes;
use App\Routes\ParticipantRoutes;
use App\Routes\AuthRoutes;
use App\Routes\DivisionRoutes;
use App\Routes\FacilityRoutes;
use App\Routes\UserRoutes;

use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

class Router
{
    private ContainerInterface $container;
    private RouteCollector $router;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->router = new RouteCollector();
        $this->defineRoutes();
    }

    private function defineRoutes(): void
    {
        $routes = [
            new CertificateRoutes($this->router, $this->container),
            new ParticipantRoutes($this->router, $this->container),
            new UserRoutes($this->router, $this->container),
            new DivisionRoutes($this->router, $this->container),
            new FacilityRoutes($this->router, $this->container),
            new AuthRoutes($this->router, $this->container),
        ];

        foreach ($routes as $route) {
            $route->register();
        }
    }

    public function dispatch(): string
    {
        $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $dispatcher = new Dispatcher($this->router->getData());
        $errorController = $this->container->get(ErrorController::class);

        try {
            return (string) $dispatcher->dispatch($_SERVER["REQUEST_METHOD"], $path);
        } catch (\Phroute\Phroute\Exception\HttpRouteNotFoundException $e) {
            return (string) $errorController->handleRouteNotFound($e->getMessage());
        } catch (\Phroute\Phroute\Exception\HttpMethodNotAllowedException $e) {
            return (string) $errorController->handleMethodNotAllowed($e->getMessage());
        } catch (\Exception $e) {
            return (string) $errorController->handleGeneralError($e->getMessage());
        }
    }
}
