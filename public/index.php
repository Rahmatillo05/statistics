<?php
declare(strict_types=1);
require_once __DIR__."/../vendor/autoload.php";
$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();
require __DIR__."/../src/main.php";