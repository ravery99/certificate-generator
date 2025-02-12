<?php

// require_once 'vendor/autoload.php';

use App\Controllers\WebhookHandler;

$rawData = file_get_contents("php://input");
$webhookHandler = new WebhookHandler($rawData);
try {
    $generatedLink = $webhookHandler->processPayload();
    $responseData = [
        'status' => 'success',
        'message' => 'Payload processed successfully.',
        'link' => $generatedLink
    ];
    $webhookHandler->respond($responseData);
} catch (Exception $e) {
    error_log($e->getMessage());
    $webhookHandler->respond(['status' => 'error', 'message' => $e->getMessage()]);
}

