<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Config\DatabaseConfig;
use App\Config\Config;
use App\Models\Participant;
use App\Services\ParticipantService;
use App\Services\LogService;
use Exception;
// use JsonException;

class ParticipantController extends Controller
{
<<<<<<< HEAD
    public function addNewParticipant()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $data = $this->validateInput($_POST);

            if ($data === false) {
                // return $this->redirectToFailPage();
                return $this->redirect(Config::BASE_URL . '/fail');
                // return $this->renderView('form', ['error' => 'Data tidak valid. Silakan coba lagi.']);
            }

            $participant_model = new ParticipantBaru();
            $participant_model->addParticipant($data);

            return $this->redirect(Config::BASE_URL . '/success');
            // return $this->redirectToSuccessPage();
        }
        $this->renderView('forms', [], "Form Trustmedis");
    }

    public function redirectToSuccessPage()
=======
    private ParticipantService $participant_service;
    private DatabaseConfig $db;

    public function __construct(ParticipantService $participant_service, DatabaseConfig $db)
    {
        $this->participant_service = $participant_service;
        $this->db = $db;
    }

    public function index()
    {
        $participant_data = $this->participant_service->getParticipants($this->db);
        $this->renderView('participants/index', '', ["page_title" => "Tabel Peserta", $participant_data]);

    }

    public function create()
    {
        $this->renderView('form', 'layout', ["page_title" => "Formulir Pembuatan Sertifikat Trustmedis"]);
    }

    // dibawah ini yg bener, yg atas buat testing
    // public function create()
    // {
    //     $this->renderView('participants/create', 'layout', ["page_title" => "Formulir Pembuatan Sertifikat Trustmedis"]);
    // }

    public function store()
    {
        try {
            $data = $this->participant_service->validateInput($this->db, $_POST);
            $participant_data = $this->participant_service->createParticipant($this->db, $data);
            $certificate_link = $this->participant_service->createCertificate($this->db, $participant_data);
            $this->participant_service->sendCertificateLink($participant_data, $certificate_link);

            // return $this->redirect(Config::BASE_URL . '/participants/success');
            $this->redirect(true, $_POST['role']);
        } catch (Exception $e) {
            LogService::logError("Submission Error", $e->getMessage(), $e);
            // return $this->redirect(Config::BASE_URL . '/participants/fail');
            $this->redirect(false, $_POST['role']);
        }
    }

    public function destroy(string $id)
    {
        try {
            $deleted = $this->participant_service->deleteParticipant($this->db, $id);
    
            if ($deleted) {
                echo json_encode(["status" => "success", "message" => "Participant deleted"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Failed to delete participant with ID: $id"]);
            }
        } catch (Exception $e) {
            LogService::logError("Deletion Error", $e->getMessage(), $e);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    
        http_response_code(200);
        exit;
    }

    // public function handleParticipantSubmission()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //         try {
    //             $data = $this->participant_service->validateInput($_POST);
    //             $participant_data = $this->participant_service->createParticipant($this->db, $data);
    //             $certificate_link = $this->participant_service->createCertificate($this->db, $participant_data);
    //             $this->participant_service->sendCertificateLink($participant_data, $certificate_link);

    //             return $this->redirect('form/successed');
    //         } catch (Exception $e) {
    //             LogService::logError("Submission Error", $e->getMessage(), $e);
    //             return $this->redirect('form/failed');
    //         }
    //     }
    //     $this->renderView('form', 'layout', ["page_title" => "Form Trustmedis"]);
    // }
    
    public function showSubmissionSuccess()
>>>>>>> aecb973cc0add02be58eb232f88a4c84752b5a0a
    {
        $data = [
            "page_title" => "Pengiriman Formulir Berhasil",
            "title" => "Formulir Terkirim",
            "desc" => "Respons Anda telah dicatat. \nSilakan cek email Anda untuk mengunduh sertifikat.",
        ];

        $this->renderView('submission_result', 'layout', $data);
    }

    public function showSubmissionFail()
    {
        $data = [
            "page_title" => "Pengiriman Formulir Gagal",
            "title" => "Gagal Menyimpan Data",
            "desc" => "Data yang dimasukkan tidak valid. \nPeriksa kembali format penulisannya dan coba lagi.",
        ];

        $this->renderView('submission_result', 'layout', $data);
    }

    // private function redirect(string $url, int $statusCode = 302)
    // {
    //     header("Location: $url", true, $statusCode);
    //     exit;
    // }

    protected function redirect(bool $success, string|null $role)
    {
        $routes = [
            'admin' => Config::BASE_URL . "/participants",
            'public' => Config::BASE_URL . "/participants/create/" . ($success ? "success" : "fail"),
        ];
<<<<<<< HEAD
        $this->checkRequiredFields($filtered_data);
        return $filtered_data;
    }

    private function checkRequiredFields($data): void
    {
        $required_fields = ['email', 'training_date', 'p_name', 'division', 'facility'];
        foreach ($required_fields as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                throw new Exception("Required field '{$field}' is missing or empty.");
            }
=======
    
        if ($role === 'admin') {
            $_SESSION['message'] = $success ? "Peserta berhasil ditambahkan!" : "Gagal menambahkan peserta.";
>>>>>>> aecb973cc0add02be58eb232f88a4c84752b5a0a
        }
    
        header("Location: $routes[$role]", true);
        exit;
    }
}