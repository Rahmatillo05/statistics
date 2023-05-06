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

    public function sorting(): bool|array|string
    {
        $sorting_dates = Application::$app->request->get('Sorting');
        $this->setInterval($sorting_dates);

        return $this->render('index', compact('sorting_dates'));
    }

    public function setInterval(array $sorting_dates): void
    {
        if ($sorting_dates['start'] && !$sorting_dates['end']) {
            $start = strtotime($sorting_dates['start']);
            $end = strtotime("today");
        } elseif (!$sorting_dates['start'] && $sorting_dates['end']) {
            $end = strtotime($sorting_dates['end']);
            $start = $end - 86399;
        } elseif ($sorting_dates['start'] && $sorting_dates['end']) {
            $start = strtotime($sorting_dates['start']);
            $end = strtotime($sorting_dates['end']);
        } else {
            $start = strtotime("today");
            $end = $start + 86399;
        }
        new Money($start, $end);
    }

}