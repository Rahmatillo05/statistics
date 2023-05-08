<?php
declare(strict_types=1);

use app\controllers\SiteController;
use app\core\Application;
use Dotenv\Dotenv;

require_once __DIR__ . "/../vendor/autoload.php";
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

$app = new Application(dirname(__DIR__));

$app->router->get('/', [SiteController::class, 'index']);
$app->router->get('/sorting', [SiteController::class, 'sorting']);
$app->router->get('/history', [SiteController::class, 'history']);

echo $app->run();