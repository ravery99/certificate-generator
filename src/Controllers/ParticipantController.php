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
    
        if ($role === 'admin') {
            $_SESSION['message'] = $success ? "Peserta berhasil ditambahkan!" : "Gagal menambahkan peserta.";
        }
    
        header("Location: $routes[$role]", true);
        exit;
    }
}