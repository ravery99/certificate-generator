<?php

namespace App\Core;

use App\Services\ExceptionHandlerService;
use App\Services\FlashMessageService;

class Service
{
    protected ExceptionHandlerService $exception_handler; 
    protected FlashMessageService $flash_service;

    public function __construct()
    {
        $this->exception_handler = new ExceptionHandlerService();
        $this->flash_service = new FlashMessageService();
    }
}