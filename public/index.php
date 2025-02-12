<?php

declare(strict_types=1);

use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

use App\Controllers\ParticipantController;
use App\Controllers\WebhookHandler;
use App\Utils\CertificateTemplate;
use App\Utils\TextStyles;

require "../vendor/autoload.php";

CertificateTemplate::init();
TextStyles::init();

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

$endpoint = "/certificate-generator/public";

$router = new RouteCollector();

// $router->get("$domain$endpoint/", function ()  {
//     return ("ini index");
// });

$router->any("$endpoint/webhook", [WebhookHandler::class, 'handle']);
$router->post("$endpoint/certificate/{email}/{name}/{timestamp}", [ParticipantController::class, 'showCertificate']);

$dispatcher = new Dispatcher($router->getData());
try {
    $response = $dispatcher->dispatch($_SERVER["REQUEST_METHOD"], $path);
    echo $response;
} catch (Phroute\Phroute\Exception\HttpRouteNotFoundException $e) {
    echo "Rute tidak ditemukan: " . $e->getMessage();
} catch (Phroute\Phroute\Exception\HttpMethodNotAllowedException $e) {
    echo "Metode tidak diizinkan: " . $e->getMessage();
} catch (Exception $e) {
    echo "Terjadi kesalahan: " . $e->getMessage();
}

// $dispatcher = new Dispatcher($router->getData());
// $reponse = $dispatcher->dispatch($_SERVER["REQUEST_METHOD"], $path);

// echo $reponse;

// require "Router.php";
// $router = new Router();
// $router->add("/certificate-generator/public/", function () {
//     echo "Ini halaman awal";
// });
// $router->add("/certificate-generator/public/expired", function () {
//     echo "Ini halaman sertifikat yang dah expired";
// });
// $router->add("/certificate-generator/public/certificate/{id}", function ($id) {
//     echo "Ini halaman sertifikat milik $id";
// });
// $router->add("/certificate-generator/public/certificate/{id}/tanggal/{date}", function ($id, $date) {
//     echo "Ini halaman sertifikat milik $id pada tanggal $date";
// });

// $router->dispatch($path);