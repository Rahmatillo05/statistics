<?php

namespace app\core\debt;

use app\core\selling\Selling;
use PDO;

class DebtHistory extends Selling
{
    public function dailyDebt(): ?array
    {
        $relations = [
            "[<]debtor" => ["debtor_id" => "id"],
            "[<]user" => ["worker_id" => "id"],
        ];
        $columns = [
            "debt_history.id",
            "debtor.full_name(debtor_name)",
            "user.username(worker)",
            "debt_history.debt_amount",
            "debt_history.pay_amount(instant_paid)",
            "debt_history.type_pay",
            "debt_history.created_at"
        ];
        return self::$db->database->select('debt_history', $relations, $columns,
            [
                'debt_history.created_at[<>]' => [self::$START_DAY, self::$END_DAY]
            ]
        );
    }

    public function findOne(array $where, string $table = 'debt_history_list'): ?array
    {
        $relations = [
            "[>]selling" => ["selling_id" => "id"],
            "[>]product" => ["selling.product_id" => "id"],
            "[>]category" => ["selling.category_id" => "id"],
            "[>]debt_history" => ["history_id" => "id"],
            "[>]debtor" => ["debt_history.debtor_id" => "id"]
        ];
        $columns = [
            'product.product_name',
            'category.category_name',
            'category.unit',
            'selling.sell_amount',
            'selling.sell_price',
            'selling.type_sell',
            'debt_history.pay_amount',
            'debtor.full_name(debtor)',
            'debtor.id(debtor_id)',
            'selling.type_pay',
            'debt_history.type_pay(instant_type_pay)',
            'selling.created_at',
        ];

        return self::$db->database->select($table, $relations, $columns, $where);
    }

    public static function debtorStat(int $debtor_id)
    {
        $query = "SELECT 
                    SUM(payment_history_list.pay_amount + debt_history.pay_amount) AS paid,
                    SUM(debt_history.debt_amount + old_debt.amount) AS total_debt
                    FROM `debtor` 
                    JOIN debt_history ON debtor.id = debt_history.debtor_id
                    JOIN payment_history_list ON debtor.id = payment_history_list.debtor_id
                    JOIN old_debt ON debtor.id = old_debt.debtor_id
                    WHERE debtor.id=$debtor_id";

        return self::$db->database->query($query)->fetch(PDO::FETCH_ASSOC);
    }

}