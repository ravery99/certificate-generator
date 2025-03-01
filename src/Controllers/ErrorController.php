<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\LogService;

class ErrorController extends Controller
{
    // private function logError($title, $message)
    // {
    //     date_default_timezone_set('Asia/Jakarta'); // Pastikan zona waktu Indonesia
    //     $log_msg = "[" . date("d-m-Y H:i:s") . "] $title: $message" . PHP_EOL;
    //     error_log($log_msg, 3, __DIR__ . "/../../logs/errors.log");
    // }


    public function handleRouteNotFound($message)
    {
        LogService::logError("Error 404", $message);

        $data = [
            "page_title" => "Halaman Tidak Ditemukan",
            "title_text" => "Error 404",
            "desc_text" => "Halaman tidak ditemukan. Periksa kembali URL atau hubungi tim support kami.",
            "message" => $message,
        ];

        $this->renderView("error", "layout",$data);
    }

    public function handleMethodNotAllowed($message)
    {
        LogService::logError("Error 405", $message);

        $data = [
            "page_title" => "Metode Tidak Diizinkan",
            "title_text" => "Error 405",
            "desc_text" => "Metode HTTP yang digunakan tidak diperbolehkan untuk URL ini. Silakan periksa kembali permintaan yang dikirim.",
            "message" => $message,
        ];

        $this->renderView("error", "layout", $data);
    }

    public function handleGeneralError($message)
    {
        LogService::logError("General Error", $message);

        $data = [
            "page_title" => "Terjadi Kesalahan",
            "title_text" => "Oops!",
            "desc_text" => "Terjadi kesalahan. Silakan coba lagi nanti atau hubungi tim support kami.",
            "message" => $message,
        ];

        $this->renderView("error", "layout", $data);
    }
}
