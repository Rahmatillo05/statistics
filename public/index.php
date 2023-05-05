<?php
declare(strict_types=1);

use app\core\Application;
use Dotenv\Dotenv;

require_once __DIR__ . "/../vendor/autoload.php";
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();
$app = new Application(dirname(__DIR__));

echo $app->run();