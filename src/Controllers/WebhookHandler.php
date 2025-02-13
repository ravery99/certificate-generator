<?php

namespace App\Controllers;

use App\Models\Participant;
use Exception;
use JsonException;

class WebhookHandler
{
    private $payload;

    // public function __construct($payload)
    // {
    //     $this->payload = $payload;
    //     file_put_contents("debug.log", $this->payload . PHP_EOL, FILE_APPEND); // Logging untuk cek payload
    // }
    public function handle()
    {
        $this->payload = file_get_contents("php://input");
        file_put_contents("debug.log", $this->payload . PHP_EOL, FILE_APPEND); // Logging untuk cek payload
        try {
            $generated_link = $this->processPayload();
            $response_data = [
                'status' => 'success',
                'message' => 'Payload processed successfully.',
                'link' => $generated_link
            ];
            $this->respond($response_data);
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->respond(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
    public function validatePayload(): array
    {
        try {
            $data = json_decode($this->payload, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new Exception('Invalid JSON format: ' . $e->getMessage());
        }
        $this->checkRequiredFields($data);
        array_walk_recursive($data, function (&$value) {
            if (is_string($value)) {
                $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            }
        });
        return $data;
    }

    public function processPayload()
    {
        $data = $this->validatePayload();

        $participant = new Participant($data);
        $generated_link = $participant->getCertificateLink();
        return $generated_link;
    }

    public function respond($data)
    {
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    private function checkRequiredFields($data): void
    {
        $required_fields = ['email', 'tanggal_training', 'nama_peserta', 'divisi', 'fasilitas_kesehatan']; // Ganti dengan nama field yang diperlukan
        foreach ($required_fields as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                throw new Exception("Required field '{$field}' is missing or empty.");
            }
        }
    }
}

// private function isPayloadEmpty(): void
// {
//     // Memeriksa apakah properti $payload ada dan tidak null
//     if (!isset($this->payload)) {
//         throw new Exception('Payload is not set.');
//     }
    
//     // Memeriksa apakah properti $payload kosong
//     if (empty($this->payload)) {
//         throw new Exception('Payload is empty.');
//     }
// }
// private function isFormatValid(): void
// {
//     // 2. Memeriksa apakah payload dalam format JSON yang valid
//     if (json_last_error() !== JSON_ERROR_NONE) {
//         throw new Exception('Invalid JSON format.');
//     }
// }
// private function isTokenValid(): void 
// {
//     $expectedToken = 'your_expected_token'; // Token yang diharapkan
//     if (!isset($data['auth_token']) || $data['auth_token'] !== $expectedToken) {
//         throw new Exception('Invalid or missing authentication token.');
//     }
// }