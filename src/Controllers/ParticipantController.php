<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Config\Config;
use App\Services\AuthService;
use App\Services\ParticipantService;

class ParticipantController extends Controller
{
    private ParticipantService $participant_service;

    public function __construct(ParticipantService $participant_service)
    {
        $this->participant_service = $participant_service;
    }

    public function index()
    {
        AuthService::check();
        $participants = $this->participant_service->getParticipants();
        $this->renderView('participants/index', 'layouts/main', [
            "page_title" => "Manajemen Peserta",
            "participants" => $participants
        ]);
    }

    public function create()
    {
        $divisions = $this->participant_service->getDivisions();
        $facilities = $this->participant_service->getFacilities();
        $this->renderView('participants/create', isset($_SESSION['user']) ? 'layouts/main' : 'layouts/base', [
            "page_title" => "Formulir Pembuatan Sertifikat Trustmedis",
            "divisions" => $divisions,
            "facilities" => $facilities,
        ]);
    }

    public function store()
    {
        $success = $this->participant_service->store();
        $user_role = $_POST['user_role'];
        $this->redirect($user_role, $success ?? false);
    }

    public function destroy(string $id)
    {
        AuthService::check();
        $this->participant_service->destroy($id);
        $this->redirect('admin');
    }

    public function showSubmissionSuccess()
    {
        $data = [
            "page_title" => "Pengiriman Formulir Berhasil",
            "title_text" => "Formulir Terkirim",
            "desc_text" => "Respons Anda telah dicatat. \nSilakan cek email Anda untuk mengunduh sertifikat.",
        ];

        $this->renderView('participants/submission_result', isset($_SESSION['user']) ? 'layouts/main' : 'layouts/base', $data);
    }

    public function showSubmissionFail()
    {
        $data = [
            "page_title" => "Pengiriman Formulir Gagal",
            "title_text" => "Gagal Menyimpan Data",
            "desc_text" => "Data yang dimasukkan tidak valid. \nPeriksa kembali format penulisannya dan coba lagi.",
        ];

        $this->renderView('participants/submission_result', isset($_SESSION['user']) ? 'layouts/main' : 'layouts/base', $data);
    }

    public function search()
    {
        $input = $_POST['input'];
        $participants = $this->participant_service->searchParticipants($input);
        $this->renderView('participants/table', 'layouts/base', [
            "participants" => $participants
        ]);
    }

    protected function redirect(string|null $user_role = null, bool|null $success = null)
    {
        $routes = [
            'admin' => Config::BASE_URL . "/participants",
            'public' => Config::BASE_URL . "/participants/create/" . ($success ? "success" : "fail"),
        ];

        header("Location: $routes[$user_role]", true, 303);
        exit;
    }
}
