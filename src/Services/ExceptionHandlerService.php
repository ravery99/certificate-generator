<?php

namespace App\Services;

use Exception;
use App\Services\LogService;

class ExceptionHandlerService
{
    private FlashMessageService $flash_service;

    public function __construct()
    {
        $this->flash_service = new FlashMessageService();
    }

    public function handle(Exception $e, string $action, string $table, string|null $id = null)
    {
        $messages = [
            'tambah' => "Gagal menambahkan ". strtolower($table) . " baru.",
            'edit' => "Gagal memperbarui ". strtolower($table) . " dengan ID $id.",
            'hapus' => "Gagal menghapus ". strtolower($table) . " dengan ID $id.",
        ];
        
        LogService::logError(ucfirst($action) . " error", $e->getMessage(), $e);
        $this->flash_service->set("error", $messages[$action] ?? "Terjadi kesalahan tak terduga.");
        http_response_code(500);
    }
}
