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

    public function allSelling(): int|string|null
    {
        return self::$db->database->sum('selling', 'sell_price', ['type_pay' => self::CASH]) ?? 0;
    }

    public function dailySelling(): int|string|null
    {
        return self::$db->database->sum('selling', 'sell_price', ['type_pay' => self::CASH, 'created_at[<>]' => [self::$START_DAY, self::$END_DAY]]) ?? 0;
    }
}
