<?php

declare(strict_types=1);

use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

use App\Controllers\ParticipantController;
use App\Controllers\WebhookHandler;

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

require "../vendor/autoload.php";

$endpoint = "/certificate-generator/public";

$router = new RouteCollector();

$router->get("$domain$endpoint/", function ()  {
    return ("ini index");
});

$router->post('/webhook', [WebhookHandler::class, 'handle']);
$router->post('/certificate/{email}/{name}/{timestamp}', [ParticipantController::class, 'showCertificate']);

$dispatcher = new Dispatcher($router->getData());
$reponse = $dispatcher->dispatch($_SERVER["REQUEST_METHOD"], $path);

echo $reponse;

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