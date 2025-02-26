<?php

namespace App\Controllers;

use App\Models\ParticipantBaru;
use App\Config\Config;
use Exception;
use JsonException;

class ParticipantController extends Controller
{
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
        $this->renderView('form', [], "Form Trustmedis");
    }
    
    public function redirectToSuccessPage()
    {
        $data = [
            "title" => "Formulir Terkirim",
            "desc" => "Respons Anda telah dicatat. \nSilakan cek email Anda untuk mengunduh sertifikat.",
        ];

        $this->renderView('submission_result', $data, "Pengiriman Formulir Berhasil");
    }

    public function redirectToFailPage()
    {
        $data = [
            "title" => "Gagal Menyimpan Data",
            "desc" => "Data yang dimasukkan tidak valid. \nPeriksa kembali format penulisannya dan coba lagi.",
        ];

        $this->renderView('submission_result', $data, "Pengiriman Formulir Gagal");
    }

    private function validateInput(array $input)
    {
        $filtered_data = [
            'email' => filter_var($input['email'] ?? '', FILTER_VALIDATE_EMAIL) ?: '',
            'training_date' => $input['training_date'] ?? '',
            'p_name' => trim($input['p_name'] ?? ''),
            'division' => trim($input['division'] ?? ''),
            'facility' => trim($input['facility'] ?? ''),
            'phone_number' => isset($input['phone_number']) && $input['phone_number'] !== ''
                ? (preg_match('/^\d{10,15}$/', $input['phone_number']) ? $input['phone_number'] : null)
                : null
        ];
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
        }
    }

    private function redirect(string $url, int $statusCode = 302)
    {
        header("Location: $url", true, $statusCode);
        exit;
    }
}