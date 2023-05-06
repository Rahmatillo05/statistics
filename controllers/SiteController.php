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
        echo date("d-m-Y H-i-s", Money::$START_DAY) . "<br>";
        echo date("d-m-Y H-i-s", Money::$END_DAY);
    }

    public function setInternal(): void
    {
        $sorting_dates = Application::$app->request->get('Sorting');
        $start = strtotime("today");
        $end = $start + 86399;
        if ($sorting_dates['start']) {
            $start = $sorting_dates['start'];
        } elseif ($sorting_dates['end']) {
            $end = $sorting_dates['end'];
        }
        new Money($start, $end);
    }

}