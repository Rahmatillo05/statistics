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

    public static function debtorStat(int $debtor_id): array
    {
        $old_debt = (float)self::$db->database->sum('old_debt', 'amount', ['debtor_id' => $debtor_id]);
        $new_debt = (float)self::$db->database->sum('debt_history', 'debt_amount', ['debtor_id' => $debtor_id]);
        $instant_paid = (float)self::$db->database->sum('debt_history', 'pay_amount', ['debtor_id' => $debtor_id]);
        $paid  = (float)self::$db->database->sum('payment_history_list', 'pay_amount', ['debtor_id' => $debtor_id]);

        $total_debt = $old_debt + $new_debt;
        $paid_debt = $paid + $instant_paid;
        $remaining = $total_debt - $paid_debt;

        return compact('total_debt', 'paid_debt', 'remaining');
    }

    public function fetchPaymentHistory(int $debtor_id): ?array
    {
        return self::$db->database->select('payment_history_list', "*", ['debtor_id' => $debtor_id]);
    }

    public static function paymentAmount(int $debtor_id): float
    {
        return (float)self::$db->database->sum('payment_history_list', 'pay_amount', ['debtor_id' => $debtor_id]);
    }

}