<?php

namespace app\core\debt;

use app\core\selling\Selling;

class DebtHistory extends Selling
{
    public function dailyDebt()
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
}