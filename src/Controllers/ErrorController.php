<?php

namespace App\Controllers;

class ErrorController extends Controller
{
    public function routeNotFound($message)
    {
        $data = [
            "title" => "Error 404",
            "desc" => "Halaman tidak ditemukan. Periksa kembali URL atau hubungi tim support kami.",
            "message" => $message,
        ];

        $this->renderView("not_found_page", $data, "Halaman Tidak Ditemukan");
    }

    public function methodNotAllowed($message)
    {
        $data = [
            "title" => "Error 405",
            "desc" => "Metode HTTP yang digunakan tidak diperbolehkan untuk URL ini. Silakan periksa kembali permintaan yang dikirim.",
            "message" => $message,
        ];

        $this->renderView("not_found_page", $data, "Metode Tidak Diizinkan");

    }

    public function error($message)
    {
        $data = [
            "title" => "Oops!",
            "desc" => "Terjadi kesalahan. Silahkan coba lagi nanti atau hubungi tim support kami.",
            "message" => $message,
        ];

        $this->renderView("not_found_page", $data, "Terjadi Kesalahan");
    }
    
}