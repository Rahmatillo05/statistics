<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Money;

class SiteController extends Controller
{
    public function index(): bool|array|string
    {
        return $this->render('index');
    }

    public function sorting()
    {
        $this->setInternal();
        echo "<pre>";
        echo date("d-m-Y H-i-s", Money::$START_DAY);
    }

    public function setInternal(): void
    {
        $sorting_dates = Application::$app->request->get('Sorting');
        $start = strtotime($sorting_dates['start']);
        $end = strtotime($sorting_dates['end']);
         $money = new Money($start, $end);
    }
    
}