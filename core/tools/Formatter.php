<?php

namespace app\core\tools;

class Formatter
{
    public static function priceFormatter(float|int $sell_price): string
    {
        return number_format($sell_price, 0, '.', ' ') . ' So\'m';
    }

    public static function dateParser(int $created_at): string
    {
        return date('H:i d.m.Y', $created_at);
    }
}