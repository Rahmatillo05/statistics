<?php
declare(strict_types=1);

use Dotenv\Dotenv;

require_once __DIR__."/../vendor/autoload.php";
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();
require __DIR__."/../src/main.php";