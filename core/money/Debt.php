<?php

namespace app\core\money;

class Debt extends Money
{
    public function dailyNewDebt(): array
    {

        $debt = (int)self::$db
            ->database
            ->sum('debt_history',
                'debt_amount',
                [
                    'created_at[<>]' => [self::$START_DAY, self::$END_DAY]
                ]
            );
        $paid = (int)self::$db
            ->database
            ->sum('debt_history',
                'pay_amount',
                [
                    'created_at[<>]' => [self::$START_DAY, self::$END_DAY]
                ]
            );
        $remaining = $debt - $paid;

        return compact('debt', 'paid', 'remaining');
    }

    public function paymentHistory(): int
    {
        return (int)self::$db
            ->database
            ->sum('payment_history_list',
                'pay_amount',
                [
                    'created_at[<>]' => [self::$START_DAY, self::$END_DAY]
                ]
            );
    }
    public function dailyDebt(): array
    {
        $old_debt = (int)self::$db
            ->database->sum(
                'old_debt',
                'amount',
                [
                    'created_at[<>]' => [self::$START_DAY, self::$END_DAY]
                ]
            );
        $all_debt = $this->dailyNewDebt()['debt'] + $old_debt;
        $paid = $this->paymentHistory() + $this->dailyNewDebt()['paid'];
        $remaining = $all_debt - $paid;
        return compact('all_debt', 'paid', 'remaining');

    }

}