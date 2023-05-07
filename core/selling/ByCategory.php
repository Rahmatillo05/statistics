<?php

namespace app\core\selling;


class ByCategory extends Selling
{
    const KG = 0;
    const EACH = 1;

    public function dailySalesByCategory(): false|array
    {
        $query = "SELECT 
            category.id as category_id,
            category.unit,
            category.category_name,
            SUM(sell_amount) as amount,
            SUM(sell_price) as price
            FROM selling LEFT JOIN
                category ON selling.category_id = category.id
            WHERE selling.created_at 
                BETWEEN " . self::$START_DAY . " AND " . self::$END_DAY . "
            GROUP BY category_id";
        return self::$db->database->query($query)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function setAmountUnit(int $amount, int $unit): string
    {
        if ($unit == self::KG) {
            return "$amount KG";
        }
        return "$amount Dona";
    }

    public function fetchMax()
    {
        $query = "SELECT 
            SUM(sell_price) as price
            FROM selling LEFT JOIN
                category ON selling.category_id = category.id
            WHERE selling.created_at 
                BETWEEN " . self::$START_DAY . " AND " . self::$END_DAY . "
            GROUP BY category_id";
        return max(self::$db->database->query($query)->fetchAll(\PDO::FETCH_ASSOC))['price'];
    }

    public function calcPercent(int $price): float|int
    {
        return $price/$this->fetchMax() * 100;
    }
    
}