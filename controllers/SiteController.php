<?php

namespace app\controllers;

use app\core\Application;
use app\core\Cash;
use app\core\Controller;
use app\core\debt\DebtHistory;
use app\core\Money;
use app\core\Plastic;
use app\core\selling\ByCategory;
use app\core\selling\Selling;

class SiteController extends Controller
{
    public function index(): bool|array|string
    {
        $cash = new Cash();
        $plastic = new Plastic();
        $selling = new Selling();
        $caty = new ByCategory();
        $debt_history = new DebtHistory();
        return $this->render('index', compact('cash', 'plastic', 'selling', 'caty', 'debt_history'));
    }

    public function sorting(): bool|array|string
    {
        $sorting_dates = Application::$app->request->get('Sorting');
        $cash = new Cash();
        $plastic = new Plastic();
        $selling = new Selling();
        $caty = new ByCategory();
        $debt_history = new DebtHistory();
        $this->setInterval($sorting_dates);
        return $this->render('index', compact('sorting_dates', 'cash', 'plastic', 'selling', 'caty', 'debt_history'));
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
        new Selling($start, $end);
    }

    public function history(): bool|array|string
    {
        $id = Application::$app->request->get('id');

        return $this->render('history');
    }


}