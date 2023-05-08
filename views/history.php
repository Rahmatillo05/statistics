
<?php

/**
 * @var DebtHistory $histories
 */

use app\core\debt\DebtHistory;
use app\core\tools\Formatter;

?>

<div class="row">
    <div class="col-12">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Mahsulot nomi</th>
                    <th>Miqdori</th>
                    <th>Narxi</th>
                    <th>Sotish turi</th>
                    <th>To'lov turi</th>
                    <th>Joyida to'langan</th>
                    <th>Qolgan</th>
                    <th>Olingan vaqti</th>
                </tr>
                </thead>
                <tbody class="table-group-divider">
                <?php foreach ($histories as $history) : ?>
                    <tr>
                        <td><?= $history['product_name'] ?></td>
                        <td><?= Formatter::setAmountUnit($history['sell_amount'], $history['unit']) ?></td>
                        <td><?= Formatter::priceFormatter($history['sell_price']) ?></td>
                        <td><?= Formatter::setTypeSell($history['type_sell']) ?></td>
                        <td><?= Formatter::setTypePayBadge($history['instant_type_pay']) ?></td>
                        <td><?= Formatter::priceFormatter($history['pay_amount']) ?></td>
                        <td><?= Formatter::remainingDebt($history['sell_price'], $history['pay_amount']) ?></td>
                        <td><?= Formatter::dateParser($history['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>