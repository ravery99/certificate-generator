<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Facility;
use App\Services\LogService;
use PDOException;
use Exception;

class FacilityController extends Controller
{
    private Facility $facility_model;

    public function __construct(Facility $facility_model)
    {
        $this->facility_model = $facility_model;
    }

    public function index()
    {
        $this->facility_model->getAllFacilities();
        $this->renderView('facilities/index', '', []);
    }

    public function create()
    {
        $this->renderView('facilities/create', '', []);
    }

    public function store()
    {
        try {
            $name = trim($_POST['name']); 
            $success = $this->facility_model->addFacility($name);
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
        $facility = $this->facility_model->getFacilityById($id);
        $this->renderView('facilities/edit', '', ['id' => $id, 'facility_name'=> $facility['name']]);
    }

    public function update(string $id)
    {
        try {
            $name = trim($_POST['name']); 
            $success = $this->facility_model->updateFacility($id, $name);
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
            $deleted = $this->facility_model->deleteFacility($$id);
    
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