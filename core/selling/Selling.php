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

    public function dailySales(): ?array
    {
        $relations = [
            "[<]category" => ["category_id" => "id"],
            "[<]product" => ["product_id" => "id"],
            "[<]user" => ["worker_id" => "id"],
        ];
        $columns = [
            "selling.id(selling_id)",
            "category.id(category_id)",
            "product.id(product_id)",
            "user.id(user_id)",
            "category.category_name",
            "product.product_name",
            "user.username(worker)",
            "selling.sell_price",
            "selling.type_pay",
            'selling.sell_amount',
            'selling.created_at'
        ];
        return self::$db->database->select('selling', $relations, $columns,
            [
                'selling.created_at[<>]' => [self::$START_DAY, self::$END_DAY]
            ]
        );
    }

    public function dailySellingCount(): int
    {
        return count($this->dailySales());
    }

    public function dailySalesAmount(): int
    {
        return (int)self::$db->database->sum('selling', 'sell_price', [
            'selling.created_at[<>]' => [self::$START_DAY, self::$END_DAY]
        ]);
    }

    public function setTypePayBadge(int $type_pay): string
    {
        $badge = "<span class='";
        if ($type_pay === self::MIX_TYPE) {
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

    public function dateParser(int $created_at): string
    {
        return date('H:i d.m.Y', $created_at);
    }

    public function priceFormatter(int $sell_price): string
    {
        return number_format($sell_price, 0, '.', ' '). ' So\'m';
    }

}