<?php
declare(strict_types=1);

use app\core\View;
use Dotenv\Dotenv;

require_once __DIR__ . "/../vendor/autoload.php";
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();
$view = new View(dirname(__DIR__));
$view->render('index');