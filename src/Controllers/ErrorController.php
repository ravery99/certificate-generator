<?php

namespace App\Controllers;

class ErrorController extends Controller
{
    private function logError($title, $message)
    {
        date_default_timezone_set('Asia/Jakarta'); // Pastikan zona waktu Indonesia
        $log_msg = "[" . date("d-m-Y H:i:s") . "] $title: $message" . PHP_EOL;
        error_log($log_msg, 3, __DIR__ . "/../../logs/errors.log");
    }


    public function handleRouteNotFound($message)
    {
        $this->logError("Error 404", $message);

        $data = [
            "title" => "Error 404",
            "desc" => "Halaman tidak ditemukan. Periksa kembali URL atau hubungi tim support kami.",
            "message" => $message,
        ];

        $this->renderView("error_page", $data, "Halaman Tidak Ditemukan");
    }

    public function handleMethodNotAllowed($message)
    {
        $this->logError("Error 405", $message);

        $data = [
            "title" => "Error 405",
            "desc" => "Metode HTTP yang digunakan tidak diperbolehkan untuk URL ini. Silakan periksa kembali permintaan yang dikirim.",
            "message" => $message,
        ];

        $this->renderView("error_page", $data, "Metode Tidak Diizinkan");
    }

    public function handleGeneralError($message)
    {
        $this->logError("General Error", $message);

        $data = [
            "title" => "Oops!",
            "desc" => "Terjadi kesalahan. Silakan coba lagi nanti atau hubungi tim support kami.",
            "message" => $message,
        ];

        $this->renderView("error_page", $data, "Terjadi Kesalahan");
    }
}
