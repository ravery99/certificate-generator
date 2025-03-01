<?php

namespace App\Services;

class LogService
{
    public static function logError($title, $message, $exception = null, $type = "error")
    {
        date_default_timezone_set('Asia/Jakarta'); // Pastikan zona waktu Indonesia
        $log_data = [
            "timestamp" => date("d-m-Y H:i:s"),
            "title" => $title,
            "message" => $message,
            "file" => $exception ? $exception->getFile() : "N/A",
            "line" => $exception ? $exception->getLine() : "N/A",
            "ip" => $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN',
            "url" => $_SERVER['REQUEST_URI'] ?? 'UNKNOWN',
            "user_agent" => $_SERVER['HTTP_USER_AGENT'] ?? 'UNKNOWN'
        ];

        $log_msg = json_encode($log_data) . PHP_EOL;
        $log_file = ($type === "security") ? "security.log" : "errors.log";

        error_log($log_msg, 3, __DIR__ . "/../../logs/$log_file");
    }
}
