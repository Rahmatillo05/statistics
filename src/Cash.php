<?php

namespace CodeCrafter\ControllerStatistics;
class Cash
{

    public static int $START_DAY;
    public static int $END_DAY;

    public static DB $db;

    const CASH = 10;

    public function __construct()
    {
        self::$START_DAY = strtotime('today');
        self::$END_DAY = self::$START_DAY + 86395;
        self::$db = new DB();
    }

    public function allSelling(): int
    {
        return (int)self::$db
            ->database
            ->sum('selling',
                'sell_price',
                [
                    'type_pay' => self::CASH
                ]);
    }

    public function dailySelling(): int
    {
        return (int)self::$db
            ->database
            ->sum('selling',
                'sell_price',
                [
                    'type_pay' => self::CASH,
                    'created_at[<>]' => [self::$START_DAY, self::$END_DAY]
                ]);
    }

    public function dailyMixSelling(): int
    {
        return (int)self::$db
            ->database
            ->sum('mix_selling',
                'on_cash',
                [
                    'created_at[<>]' => [self::$START_DAY, self::$END_DAY]
                ]);
    }

    public function dailyPayment(): int
    {
        return (int)self::$db
            ->database
            ->sum('payment_history_list',
                'pay_amount',
                [
                    'created_at[<>]' => [self::$START_DAY, self::$END_DAY],
                    'type_pay' => self::CASH
                ]);
    }
}
