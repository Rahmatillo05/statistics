<?php

use app\core\tools\Formatter;

/**
 * @var \app\core\debt\DebtHistory $debt_history
 */

$debts = $debt_history->dailyDebt();

?>
<div class="table-responsive">
    <table class="table table-bordered" id="debt_history">
        <thead>
        <tr>
            <th>Qarzdor</th>
            <th>Qarz summasi</th>
            <th>Joyida to'landi</th>
            <th>To'lov turi</th>
            <th>Ishchi</th>
            <th>Sotish vaqti</th>
            <th>...</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($debts) : foreach ($debts as $debt) : ?>
            <tr>
                <td><?= $debt['debtor_name'] ?></td>
                <td><?= Formatter::priceFormatter($debt['debt_amount']) ?></td>
                <td><?= Formatter::priceFormatter($debt['instant_paid']) ?></td>
                <td><?= Formatter::setTypePayBadge($debt['type_pay'], $debt['instant_paid']) ?></td>
                <td><?= $debt['worker'] ?></td>
                <td><?= Formatter::dateParser($debt['created_at']) ?></td>
                <td><a href="/history?id=<?= $debt['debtor_id'] ?>&history_id=<?= $debt['id'] ?>"
                       class="btn btn-sm btn-info">Batafsil</a></td>
            </tr>
        <?php endforeach; else: ?>
            <tr>
                <th class="text-danger" colspan="6">Qarz sotishlar yo'q!</th>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
