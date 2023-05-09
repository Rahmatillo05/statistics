<?php

namespace app\core\tools;

class Formatter
{
    const CASH = 10; # naqd pul
    const PLASTIC = 0; # plastikka savdo

    const DEBT = 5; # qarzga

    const MIX_TYPE = 15; # Aralash holatda
    const KG = 0;
    const EACH = 1;
    const RETAIL = 0;
    const GOOD = 10;
    public static function priceFormatter(float|int $sell_price): string
    {
        return number_format($sell_price, 0, '.', ' ') . ' So\'m';
    }

    public static function dateParser(int $created_at): string
    {
        return date('H:i d.m.Y', $created_at);
    }
    public static function setAmountUnit(int $amount, int $unit): string
    {
        if ($unit == self::KG) {
            return "$amount KG";
        }
        return "$amount Dona";
    }

    public static function setTypePayBadge(int $type_pay, float|int $pay_amount): string
    {
        $badge = "<span class='";
        if ($pay_amount === 0){
            $badge .= "badge bg-danger'>To'lanmagan";
        }elseif ($type_pay === self::MIX_TYPE) {
            $badge .= "badge bg-info'>Aralash holatda";
        } elseif ($type_pay === self::DEBT) {
            $badge .= "badge bg-danger'>Qarzga";
        } elseif ($type_pay === self::PLASTIC) {
            $badge .= "badge bg-warning'>Plastikka";
        } else {
            $badge .= "badge bg-success'>Naqd pulga";
        }
        $badge .= "</span>";
        return $badge;
    }

    public static function setTypeSell($type_sell): string
    {
        if ($type_sell == self::RETAIL){
            return "<span class='badge badge-success'>Chakana</span>";
        }
        return "<span class='badge badge-info'>Optom</span>";
    }

    public static function remainingDebt($all_debt, $paid): string
    {
        $res = $all_debt - $paid;
        return self::priceFormatter($res);
    }

    public static function calcPercent(int|float $num1, int|float $num2): float|int
    {
        return $num1 / $num2 * 100;
    }
}