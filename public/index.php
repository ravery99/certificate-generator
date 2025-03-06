<?php

// declare(strict_types=1);

// use Phroute\Phroute\RouteCollector;
// use Phroute\Phroute\Dispatcher;
// use DI\ContainerBuilder;


// use App\Controllers\FormController;
// use App\Controllers\CertificateController;
// use App\Controllers\WebhookHandler;
// use App\Utils\CertificateTemplate;
// use App\Utils\TextStyles;
// use App\Controllers\ErrorController;
// use App\Services\FormService;
// use App\Config\DatabaseConfig;

// require "../vendor/autoload.php";

// CertificateTemplate::init();
// TextStyles::init();

// $containerBuilder = new ContainerBuilder();
// $containerBuilder->addDefinitions([
//     FormService::class => \DI\autowire(FormService::class),
//     DatabaseConfig::class => \DI\autowire(DatabaseConfig::class),
//     FormController::class => \DI\autowire(FormController::class),
//     CertificateController::class => \DI\autowire(CertificateController::class),
//     ErrorController::class => \DI\autowire(ErrorController::class),
// ]);

// $container = $containerBuilder->build();

// $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
// $endpoint = "/certificate-generator/public";

// $router = new RouteCollector();
// // $form_service = new FormService();
// // $db = new DatabaseConfig();
// // $participant_controller = new FormController($form_service, $db);

// // $router->any("$endpoint/webhook", [WebhookHandler::class, 'handle']); //delete later
// $router->any("$endpoint/form", [FormController::class, 'handleParticipantSubmission']);
// $router->get("$endpoint/success", [FormController::class, 'redirectToSuccessPage']);
// $router->get("$endpoint/fail", [FormController::class, 'redirectToFailPage']);
// $router->get("$endpoint/certificate/{email}/{name}/{timestamp}", [CertificateController::class, 'showCertificate']);

// $dispatcher = new Dispatcher($router->getData());
// $errorController = $container->get(ErrorController::class);

// try {
//     $response = $dispatcher->dispatch($_SERVER["REQUEST_METHOD"], $path);
//     echo $response;
// } catch (Phroute\Phroute\Exception\HttpRouteNotFoundException $e) {
//     $errorController->handleRouteNotFound($e->getMessage());
// } catch (Phroute\Phroute\Exception\HttpMethodNotAllowedException $e) {
//     $errorController->handleMethodNotAllowed($e->getMessage());
// } catch (Exception $e) {
//     $errorController->handleGeneralError($e->getMessage());
// }


declare(strict_types=1);

require "../vendor/autoload.php";

use App\Core\Router;
use App\Core\AppContainer;
use App\Utils\CertificateTemplate;
use App\Utils\TextStyles;

CertificateTemplate::init();
TextStyles::init();

$container = (new AppContainer())->getContainer(); // Inisialisasi DI container
$router = new Router($container); // Inisialisasi Router

<<<<<<< HEAD
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

=======
$response = $router->dispatch(); // Jalankan router
echo $response;
>>>>>>> aecb973cc0add02be58eb232f88a4c84752b5a0a
