<?php

namespace App\Core;

abstract class Controller
{
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

    protected function redirect(bool $success, string|null $role)
    {
        throw new \Exception("Method redirect() is not implemented in " . static::class);
    }
}
