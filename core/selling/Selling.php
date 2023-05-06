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
    }

    public function daily(): ?array
    {
        return self::$db->database->select('selling', "*", ['created_at[<>]' => [strtotime('today'), strtotime('today') + 86399]]);
    }
}