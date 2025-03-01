<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Division;
use App\Services\LogService;
use PDOException;
use Exception;

class DivisionController extends Controller
{
    private Division $division_model;

    public function __construct(Division $division_model)
    {
        $this->division_model = $division_model;
    }

    public function index()
    {
        $this->division_model->getAllDivisions();
        $this->renderView('divisions/index', '', []);
    }

    public function create()
    {
        $this->renderView('divisions/create', '', []);
    }

    public function store()
    {
        try {
            $name = trim($_POST['name']); 
            $success = $this->division_model->addDivision($name);
            $_SESSION['message'] = "Division added successfully!";
        } catch (PDOException $e) { 
            LogService::logError("Database Error", $e->getMessage(), $e);
            $_SESSION['message'] = "Failed to add division. Please try again.";
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
        $division = $this->division_model->getDivisionById($id);
        $this->renderView('divisions/edit', '', ['id' => $id, 'division_name'=> $division['name']]);
    }

    public function update(string $id)
    {
        try {
            $name = trim($_POST['name']); 
            $success = $this->division_model->updateDivision($id, $name);
            $_SESSION['message'] = "Division updated successfully!";
        } catch (PDOException $e) { 
            LogService::logError("Database Error", $e->getMessage(), $e);
            $_SESSION['message'] = "Failed to update division. Please try again.";
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
            $deleted = $this->division_model->deleteDivision($$id);
    
            if ($deleted) {
                echo json_encode(["status" => "success", "message" => "Division deleted successfully!"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Failed to delete division with ID: $id"]);
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