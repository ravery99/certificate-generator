<?php

namespace App\Controllers;

use App\Config\Config;
use App\Core\Controller;
use App\Models\User;
use App\Services\LogService;
use PDOException;
use Exception;

class UserController extends Controller
{
    private User $user_model;

    public function __construct(User $user_model)
    {
        $this->user_model = $user_model;
    }

    public function index()
    {
        $users = $this->user_model->getAllUsers();
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
        try {
            $username = trim($_POST['username']);
            $password = $_POST['password'];

            if ($this->user_model->findUser($username)) {
                $this->flash_service->set("error", "User '$username' sudah ada.");
                http_response_code(409);
            } else {
                $success = $this->user_model->addUser($username, $password);
                $this->flash_service->set(
                    $success ? "success" : "error",
                    $success ? "User baru berhasil ditambahkan!" : "Gagal menambahkan user '$username'. Terjadi kesalahan saat menyimpan data.");
    
                http_response_code($success ? 201 : 500);
            }
        } catch (Exception $e) { 
            $this->exception_handler->handle($e, 'tambah', 'user');
        }
        $this->redirect();
    }

    public function edit(string $id)
    {
        $user = $this->user_model->getUserById($id);
        $this->renderView('users/edit', 'layouts/', ['id' => $id, 'username'=> $user['username']]);
    }

    public function update(string $id)
    {
        try {
            $username = trim($_POST['name']); 
            $password = $_POST['password'];

            if ($this->user_model->findUser($username)) {
                $this->flash_service->set("error", "User '$username' sudah ada.");
                http_response_code(409);
            } else {
                $success = $this->user_model->updateUser($id, $username, $password);
                $this->flash_service->set(
                    $success ? "success" : "error",
                    $success ? "User dengan ID $id berhasil diperbarui!" : "Gagal memperbarui user dengan ID $id. Terjadi kesalahan saat menyimpan data.");
    
                http_response_code($success ? 200 : 500);
            }
        } catch (Exception $e) { 
            $this->exception_handler->handle($e, 'edit', 'user', $id);
        }
        $this->redirect();
    }

    public function destroy(string $id)
    {
        try {
            $deleted = $this->user_model->deleteUser($$id);
            $this->flash_service->set(
                $deleted ? "success" : "error",
                $deleted ? "User dengan ID $id berhasil dihapus!" : "User dengan ID $id sudah tidak tersedia. Silakan muat ulang halaman dan coba lagi.");

            http_response_code($deleted ? 200 : 404);
        } catch (Exception $e) { 
            $this->exception_handler->handle($e, 'hapus', 'user', $id);
        }
        $this->redirect();
    }

    protected function redirect(string|null $user_role = null, bool|null $success = null)
    {
        header("Location: " . Config::BASE_URL . "/users");
        exit;
    }
}