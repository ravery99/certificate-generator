<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Config\DatabaseConfig;
use App\Config\Config;
use App\Services\ParticipantService;
use Exception;

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
        parent::__construct(); 
        $this->participant_service = $participant_service;
        $this->db = $db;
    }

    public function index()
    {
        $participants = $this->participant_service->getParticipants($this->db);
        $this->renderView('participants/index', 'layouts/main', [
            "page_title" => "Tabel Peserta", 
            "participants" => $participants
        ]);
    }

    public function create()
    {
        $divisions = $this->participant_service->getDivisions($this->db);
        $facilities = $this->participant_service->getFacilities($this->db);
        $this->renderView('participants/create', 'layouts/main', [
            "page_title" => "Formulir Pembuatan Sertifikat Trustmedis",
            "divisions" => $divisions,
            "facilities" => $facilities,
        ]);
    }

    public function store()
    {
        try {
            $data = $this->participant_service->validateInput($this->db, $_POST);
            $participant_data = $this->participant_service->createParticipant($this->db, $data);
            
            $participant_division_name = $this->participant_service->getParticipantDivisionName($this->db, $participant_data['division_id']);
            $participant_facility_name = $this->participant_service->getParticipantFacilityName($this->db, $participant_data['facility_id']);
            $certificate_data = array_merge($participant_data, [
                "division_name" => $participant_division_name,
                "facility_name" => $participant_facility_name
            ]);
            
            $certificate_link = $this->participant_service->createCertificate($this->db, $certificate_data);
            $this->participant_service->sendCertificateLink($participant_data, $certificate_link);

            $this->flash_service->set("success", "Peserta baru berhasil ditambahkan!");
            $user_role = $data['user_role'] ?? 'public';
            $this->redirect($user_role, true);

        } catch (Exception $e) {
            $this->exception_handler->handle($e, 'tambah', 'peserta');
            $user_role = $_POST['user_role'] ?? 'public';
            $this->redirect($user_role, false);
        }
    }

    public function destroy(string $id)
    {
        try {
            $deleted = $this->participant_service->deleteParticipant($this->db, $id);
            
            $this->flash_service->set(
                $deleted ? "success" : "error",
                $deleted ? "Peserta dengan ID $id berhasil dihapus!" : "Peserta dengan ID $id sudah tidak tersedia. Silakan muat ulang halaman dan coba lagi.");

            http_response_code($deleted ? 200 : 404);
        } catch (Exception $e) { 
            $this->exception_handler->handle($e, 'hapus', 'peserta', $id);
        }
        $this->redirect('admin');
    }
    
    public function showSubmissionSuccess()
>>>>>>> aecb973cc0add02be58eb232f88a4c84752b5a0a
    {
        $data = [
            "page_title" => "Pengiriman Formulir Berhasil",
            "title_text" => "Formulir Terkirim",
            "desc_text" => "Respons Anda telah dicatat. \nSilakan cek email Anda untuk mengunduh sertifikat.",
        ];

        $this->renderView('participants/submission_result', 'layout', $data);
    }

    public function showSubmissionFail()
    {
        $data = [
            "page_title" => "Pengiriman Formulir Gagal",
            "title_text" => "Gagal Menyimpan Data",
            "desc_text" => "Data yang dimasukkan tidak valid. \nPeriksa kembali format penulisannya dan coba lagi.",
        ];

        $this->renderView('participants/submission_result', 'layout', $data);
    }

    protected function redirect(string|null $user_role = null, bool|null $success = null)
    {
        $routes = [
            'admin' => Config::BASE_URL . "/participants",
            'public' => Config::BASE_URL . "/participants/create/" . ($success ? "success" : "fail"),
        ];

        header("Location: $routes[$user_role]", true);
        exit;
    }
}