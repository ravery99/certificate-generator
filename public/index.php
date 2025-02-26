<?php

declare(strict_types=1);

use App\Controllers\ParticipantController;
use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

use App\Controllers\CertificateController;
use App\Controllers\WebhookHandler;
use App\Utils\CertificateTemplate;
use App\Utils\TextStyles;
use App\Controllers\ErrorController;

require "../vendor/autoload.php";

CertificateTemplate::init();
TextStyles::init();

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

$endpoint = "/certificate-generator/public";

$router = new RouteCollector();
// $router->any("$endpoint/webhook", [WebhookHandler::class, 'handle']); //delete later
$router->any("$endpoint/form", [ParticipantController::class,'addNewParticipant']);
// $router->get("$endpoint/form", [ParticipantController::class,'addNewParticipant']);

$router->get("$endpoint/success", [ParticipantController::class,'redirectToSuccessPage']);
$router->get("$endpoint/fail", [ParticipantController::class,'redirectToFailPage']);
$router->get("$endpoint/certificate/{email}/{name}/{timestamp}", [CertificateController::class, 'showCertificate']);

$dispatcher = new Dispatcher($router->getData());
$errorController = new ErrorController();

try {
    $response = $dispatcher->dispatch($_SERVER["REQUEST_METHOD"], $path);
    echo $response;
} catch (Phroute\Phroute\Exception\HttpRouteNotFoundException $e) {
    $errorController->handleRouteNotFound($e->getMessage());
} catch (Phroute\Phroute\Exception\HttpMethodNotAllowedException $e) {
    $errorController->handleMethodNotAllowed($e->getMessage());
} catch (Exception $e) {
    $errorController->handleGeneralError($e->getMessage());
}
