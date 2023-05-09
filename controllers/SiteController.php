<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\debt\DebtHistory;
use app\core\money\Cash;
use app\core\money\Debt;
use app\core\money\Money;
use app\core\money\Plastic;
use app\core\money\Statistics;
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
        $debt = new Debt();
        $statistics = new Statistics();
        return $this->render('index', compact('cash', 'plastic', 'statistics', 'debt', 'selling', 'caty', 'debt_history'));
    }

    public function sorting(): bool|array|string
    {
        $sorting_dates = Application::$app->request->get('Sorting');
        $cash = new Cash();
        $plastic = new Plastic();
        $selling = new Selling();
        $caty = new ByCategory();
        $debt_history = new DebtHistory();
        $debt = new Debt();
        $statistics = new Statistics();
        $this->setInterval($sorting_dates);
        return $this->render('index', compact('sorting_dates', 'statistics', 'cash', 'debt', 'plastic', 'selling', 'caty', 'debt_history'));
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
        $histories = (new DebtHistory())->findOne(['debtor.id' => $id, 'ORDER' => ['debt_history.created_at' => 'DESC']]);
        if ($histories) {
            return $this->render('history', compact('histories'));
        } else {
            return $this->render('error');
        }
    }


}