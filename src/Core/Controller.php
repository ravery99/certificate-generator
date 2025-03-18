<?php

namespace App\Core;

use App\Services\ExceptionHandlerService;
use App\Services\FlashMessageService;

abstract class Controller
{
    protected ExceptionHandlerService $exception_handler;
    protected FlashMessageService $flash_service;

    public function __construct()
    {
        $this->exception_handler = new ExceptionHandlerService();
        $this->flash_service = new FlashMessageService();
    }

    protected function renderView(string $view_path, string $layout_path, array $data = [])
    {
        extract($data);
        
        include __DIR__ . "/../../src/Views/$layout_path.php";
    }

    public function index()
    {
        throw new \Exception("Method index() is not implemented in " . static::class);
    }

    public function create()
    {
        throw new \Exception("Method create() is not implemented in " . static::class);
    }

    public function store()
    {
        throw new \Exception("Method store() is not implemented in " . static::class);
    }

    public function edit(string $id)
    {
        throw new \Exception("Method edit() is not implemented in " . static::class);
    }

    public function update(string $id)
    {
        throw new \Exception("Method update() is not implemented in " . static::class);
    }

    public function destroy(string $id)
    {
        throw new \Exception("Method destroy() is not implemented in " . static::class);
    }

    protected function redirect(string|null $user_role = null, bool|null $success = null)
    {
        throw new \Exception("Method redirect() is not implemented in " . static::class);
    }
}
