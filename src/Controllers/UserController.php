<?php

namespace App\Controllers;

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
        $this->user_model->getAllUsers();
        $this->renderView('users/index', '', []);
    }

    public function create()
    {
        $this->renderView('users/create', '', []);
    }

    public function store()
    {
        try {
            $username = trim($_POST['username']);
            $password = $_POST['password'];
            $success = $this->user_model->addUser($username, $password);
            $_SESSION['message'] = "User added successfully!";
        } catch (PDOException $e) { 
            LogService::logError("Database Error", $e->getMessage(), $e);
            $_SESSION['message'] = "Failed to add user. Please try again.";
            $success = false;
        } catch (Exception $e) { 
            LogService::logError("General Error", $e->getMessage(), $e);
            $_SESSION['message'] = "An unexpected error occurred.";
            $success = false;
        }
        $this->redirect($success);
    }

    public function edit(string $id)
    {
        $user = $this->user_model->getUserById($id);
        $this->renderView('users/edit', '', ['id' => $id, 'username'=> $user['username']]);
    }

    public function update(string $id)
    {
        try {
            $username = trim($_POST['name']); 
            $password = $_POST['password'];
            $success = $this->user_model->updateUser($id, $username, $password);
            $_SESSION['message'] = "User updated successfully!";
        } catch (PDOException $e) { 
            LogService::logError("Database Error", $e->getMessage(), $e);
            $_SESSION['message'] = "Failed to update user. Please try again.";
            $success = false;
        } catch (Exception $e) { 
            LogService::logError("General Error", $e->getMessage(), $e);
            $_SESSION['message'] = "An unexpected error occurred.";
            $success = false;
        }
        $this->redirect($success);
    }

    public function destroy(string $id)
    {
        try {
            $deleted = $this->user_model->deleteUser($$id);
    
            if ($deleted) {
                echo json_encode(["status" => "success", "message" => "User deleted successfully!"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Failed to delete user with ID: $id"]);
            }
        } catch (Exception $e) {
            LogService::logError("Deletion Error", $e->getMessage(), $e);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    
        http_response_code(200);
        exit;
    }

    protected function redirect(bool $success, string|null $role = null)
    {
        // TODO: buat bisa /create dan /edit
        $url = $success ? "/divisions" : "/divisions/create";
        header("Location: $url");
        exit;
    }
}