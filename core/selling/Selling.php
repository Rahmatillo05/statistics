<?php

namespace app\core\selling;

use app\core\DB;

class Selling
{
    public static int $START_DAY;
    public static int $END_DAY;

    public static DB $db;

    const CASH = 10; # naqd pul
    const PLASTIC = 0; # plastikka savdo

    const DEBT = 5; # qarzga

    const MIX_TYPE = 15; # Aralash holatda

    public function __construct()
    {
        self::$db = new DB();
        self::$START_DAY = strtotime('today');
        self::$END_DAY = static::$START_DAY + 86399;
    }

    public function daily(array $columns = []): ?array
    {
        if (!empty($columns) && count($columns) != 1) {
            return self::$db->database->select('selling', [
                "[>]category" => ["category_id" => "id"]
            ], $columns
            );
        }

        return self::$db->database->select('selling', "*",
            [
                'created_at[<>]' => [self::$START_DAY, self::$END_DAY]
            ]
        );
    }

    public function dailySellingCount(): int
    {
        return count($this->daily());
    }
}