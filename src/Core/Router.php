<?php

declare(strict_types=1);

namespace App\Core;

use App\Controllers\ErrorController;
use Psr\Container\ContainerInterface;
use App\Routes\CertificateRoutes;
use App\Routes\ParticipantRoutes;

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
        //  = "/certificate-generator/public";

        // // Gunakan closure supaya controller diambil dari DI container
        // $this->router->any(Config::BASE_URL . "/form", $this->resolve(FormController::class, 'handleParticipantSubmission'));
        // $this->router->get(Config::BASE_URL . "/success", $this->resolve(FormController::class, 'redirectToSuccessPage'));
        // $this->router->get(Config::BASE_URL . "/fail", $this->resolve(FormController::class, 'redirectToFailPage'));
        // $this->router->get(Config::BASE_URL . "/certificate/{email}/{name}/{timestamp}", function($email, $name, $timestamp) {
        //     return $this->resolve(CertificateController::class, 'showCertificate', [$email, $name, $timestamp]);
        // });
        $routes = [
            new CertificateRoutes($this->router, $this->container),
            new ParticipantRoutes($this->router, $this->container),
        ];

        foreach ($routes as $route) {
            $route->register();
        }
    }

    // private function resolve(string $controller, string $method, array $params = [])
    // {
    //     return function() use ($controller, $method, $params) {
    //         return call_user_func_array([$this->container->get($controller), $method], $params);
    //     };
    // }

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
