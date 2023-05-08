<?php

namespace app\core;

class Money
{
    public static int $START_DAY;
    public static int $END_DAY;

    public static DB $db;

    const CASH = 10; # naqd pul
    const PLASTIC = 0; # plastikka savdo

    const DEBT = 5; # qarzga

    const MIX_TYPE = 15; # Aralash holatda

    public function __construct(int $START_DAY = null, int $END_DAY = null)
    {
        if (is_null($START_DAY) || is_null($END_DAY)) {
            self::$START_DAY = strtotime('today');
            self::$END_DAY = self::$START_DAY + 86395;
        } else {
            self::$START_DAY = $START_DAY;
            self::$END_DAY = $END_DAY;
        }
        self::$db = new DB();
    }

}