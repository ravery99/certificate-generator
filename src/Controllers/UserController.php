<?php

namespace App\Controllers;

use App\Config\Config;
use App\Core\Controller;
use App\Services\AuthService;
use App\Services\UserService;

class UserController extends Controller
{
    private UserService $user_service;

    public function __construct(UserService $user_service)
    {
        AuthService::check();
        $this->user_service = $user_service;
    }

    public function index()
    {
        $users = $this->user_service->getUsers();
        $this->renderView('users/index', 'layouts/main', [
            "page_title" => "Tabel Admin",
            "users" => $users
        ]);
    }

    public function create()
    {
        $this->renderView('users/create', 'layouts/', [
            "page_title" => "Formulir Tambah Admin Baru",
        ]);
    }

    public function store()
    {
        $this->user_service->store();
        $this->redirect();
    }

    public function edit(string $id)
    {
        $user = $this->user_service->getUserById($id);
        $this->renderView('users/edit', 'layouts/', ['id' => $id, 'username' => $user['username']]);
    }

    public function update(string $id)
    {
        $this->user_service->update($id);
        $this->redirect();
    }

    public function destroy(string $id)
    {
        $this->user_service->destroy($id);
        $this->redirect();
    }

    protected function redirect(string|null $user_role = null, bool|null $success = null)
    {
        header("Location: " . Config::BASE_URL . "/users", true, 303);
        exit;
    }
}
