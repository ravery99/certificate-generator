<?php

namespace App\Core;

use Phroute\Phroute\RouteCollector;
use Psr\Container\ContainerInterface;

abstract class Routes
{
    protected RouteCollector $router;
    protected ContainerInterface $container;

    public function __construct(RouteCollector $router, ContainerInterface $container)
    {
        $this->router = $router;
        $this->container = $container;
    }

    abstract public function register(): void;

    protected function resolve(string $controller, string $method)
    {
        return function (...$params) use ($controller, $method) {
            return $this->container->get($controller)->$method(...$params);
        };
    }
}
