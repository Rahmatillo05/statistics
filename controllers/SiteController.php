<?php

namespace app\controllers;

use app\core\Controller;

class SiteController extends Controller
{
    public function index(): bool|array|string
    {
        return $this->render('index');
    }
}