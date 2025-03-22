<?php

namespace App\Controllers;

use App\Config\Config;
use App\Core\Controller;
use App\Services\AuthService;
use App\Services\LogService;
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
        // if (isset($_POST['search_input']) && isset($_SESSION['search_results'])) {
        //     $users = $_SESSION['search_results'];
        //     // LogService::logError("Testing search()", "Isi search_result : $users");
        // } else {
        //     $users = $this->user_service->getUsers();
        // }
        $users = $this->user_service->getUsers();
        $this->renderView('users/index', 'layouts/main', [
            "page_title" => "Manajemen Admin",
            "users" => $users
        ]);
    }

    public function create()
    {
        $this->renderView('users/create', 'layouts/main', [
            "page_title" => "Form Pendaftaran Admin",
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
        $this->renderView('users/edit', 'layouts/main', ['page_title' => 'Form Edit Admin', 'id' => $id, 'username' => $user['username']]);
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

    public function search()
    {
        $input = $_POST['input'];
        $users = $this->user_service->search($input);
        $this->renderView('users/table', 'layouts/base', [
            "users" => $users
        ]);
    }

    protected function redirect()
    {
        header("Location: " . Config::BASE_URL . "/users", true, 303);
        exit;
    }
}
