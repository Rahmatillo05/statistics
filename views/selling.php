<?php

use app\core\selling\Selling;
use app\core\tools\Formatter;

/**
 * @var Selling $selling
 */


$sales = $selling->dailySales();
?>

<div class="table-responsive">
    <table class="table table-bordered" id="selling-table" style="width: 100%">
        <thead>
        <tr>
            <th>Katalog nomi</th>
            <th>Mahsulot nomi</th>
            <th>Sotish hajmi</th>
            <th>To'langan summa</th>
            <th>To'lov turi</th>
            <th>Ishchi</th>
            <th>Sotish vaqti</th>
        </tr>
        </thead>
        <tbody class="table-group-divider">
        <?php if ($sales) : foreach ($sales as $sale) : ?>
            <tr>
                <td><?= $sale['category_name'] ?></td>
                <td><?= $sale['product_name'] ?></td>
                <td><?= Formatter::setAmountUnit($sale['sell_amount'], $sale['unit']) ?></td>
                <td><?= Formatter::priceFormatter($sale['sell_price']) ?></td>
                <td><?= $selling->setTypePayBadge($sale['type_pay']) ?></td>
                <td><?= $sale['worker'] ?></td>
                <td><?= Formatter::dateParser($sale['created_at']) ?></td>
            </tr>
        <?php endforeach; else: ?>
            <tr>
                <th colspan="7" class="text-danger">
                    Bugun hech qanday sotuv amalga oshmadi!
                </th>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

