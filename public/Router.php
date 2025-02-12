<?php

declare(strict_types= 1);

class Router 
{
    private array $routes = [];

    public function add(string $path, CLosure $handler): void
    {
        $this->routes[$path] = $handler;  
    }

    public function dispatch(string $path): void
    {
        // if(array_key_exists($path, $this->routes)){
        //     $handler = $this->routes[$path];
        //     call_user_func($handler);
        // } else {
        //     echo "Halaman tidak ditemukan.";
        // }
        
        foreach($this->routes as $route => $handler) {
            $pattern = preg_replace("#\{\w+\}#", "([^\/]+)", $route);
            if (preg_match("#^$pattern$#", $path, $matches)){
                array_shift($matches);
                call_user_func_array($handler, $matches);

                // print_r($matches);
                return;
            }
        }
        
        echo "Halaman tidak ditemukan.";
    }
}