<?php
declare(strict_types=1);

require "../vendor/autoload.php";

use App\Core\Router;
use App\Core\AppContainer;
use App\Utils\CertificateTemplate;
use App\Utils\TextStyles;

CertificateTemplate::init();
TextStyles::init(CertificateTemplate::getImage());

session_start();

$container = (new AppContainer())->getContainer(); 
$router = new Router($container); 

$response = $router->dispatch(); 
echo $response;
