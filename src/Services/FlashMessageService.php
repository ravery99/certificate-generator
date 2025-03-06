<?php

namespace App\Services;

class FlashMessageService
{
    public function set(string $type, string $message)
    {
        $_SESSION['flash'] = ["type" => $type, "message" => $message];
    }

    public function get(): ?array
    {
        $messages = $_SESSION['flash'] ?? null;
        unset($_SESSION['flash']); 
        return $messages;
    }
}
