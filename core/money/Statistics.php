<?php

namespace app\core\money;

use PDO;

class Statistics extends Money
{
    public function allSum(): int
    {
        $selling = (int)self::$db->database->sum('selling', 'sell_price', [
            'created_at[<>]' => [self::$START_DAY, self::$END_DAY]
        ]);
        $paid = (int)self::$db
            ->database
            ->sum('payment_history_list',
                'pay_amount',
                [
                    'created_at[<>]' => [self::$START_DAY, self::$END_DAY]
                ]
            );;
        return $selling + $paid;
    }

    public function otherSpent(): int
    {
        return (int)self::$db->database->sum('other_spent', 'sum', [
            'created_at[<>]' => [self::$START_DAY, self::$END_DAY]
        ]);
    }

    public function productSum(): int
    {
        $query = "SELECT
                    SUM(selling.sell_amount * product.purchase_price) AS product_price
                    FROM selling
                    JOIN product on selling.product_id = product.id
                    WHERE selling.created_at BETWEEN " . self::$START_DAY . " AND " . self::$END_DAY;
        return (int)self::$db->database->query($query)->fetch(PDO::FETCH_ASSOC)['product_price'];
    }

    public function profit()
    {
        return $this->allSum() - $this->productSum();
    }

    public function netProfit($plastic_tax)
    {
        return $this->profit() - $plastic_tax - $this->otherSpent();
    }

    public function noPaidDebt()
    {
        $query = "SELECT 
                    SUM(debt_history.debt_amount - debt_history.pay_amount) as debt
                    FROM debt_history WHERE 
                                            created_at BETWEEN ". self::$START_DAY ." AND ".self::$END_DAY;
        return (int)self::$db->database->query($query)->fetch(PDO::FETCH_ASSOC)['debt'];
    }
}