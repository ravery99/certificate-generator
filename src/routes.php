<?php

require_once "../controller/ParticipantController.php";

$routes = [
    "certificate/show" => [ParticipantController::class, "showCertificate"],
];

// Ambil URL dari request
$requestUri = trim($_SERVER["REQUEST_URI"], "/");

// Cek apakah ada dalam daftar routes
if (array_key_exists($requestUri, $routes)) {
    [$controller, $method] = $routes[$requestUri];
    
    $controllerInstance = new $controller();
    $controllerInstance->$method();
} else {
    http_response_code(404);
    echo json_encode(["status" => "error", "message" => "Route not found"]);
}
?>
