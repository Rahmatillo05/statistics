<?php

namespace app\core;

class Plastic extends Money
{
    public function allSelling(): int
    {
        return (int)self::$db
            ->database
            ->sum('selling',
                'sell_price',
                [
                    'type_pay' => self::PLASTIC
                ]);
    }
    public function dailySelling(): int
    {
        return (int)self::$db
            ->database
            ->sum('selling',
                'sell_price',
                [
                    'type_pay' => self::PLASTIC,
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

    public function dailyInstantPayment(): int
    {
        return (int)self::$db
            ->database
            ->sum('payment_history_list',
                'pay_amount',
                [
                    'created_at[<>]' => [self::$START_DAY, self::$END_DAY],
                    'type_pay' => self::PLASTIC
                ]);
    }

    public function dailyPaidDebt(): int
    {
        return (int)self::$db
            ->database
            ->sum('debt_history',
                'pay_amount',
                [
                    'created_at[<>]' => [self::$START_DAY, self::$END_DAY],
                    'type_pay' => self::PLASTIC
                ]);
    }

    public function dailyTotalCash(): int
    {
        return $this->dailyInstantPayment() + $this->dailySelling() + $this->dailyMixSelling() + $this->dailyPaidDebt();
    }
}