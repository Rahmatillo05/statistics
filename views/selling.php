<?php

use app\core\selling\Selling;

/**
 * @var Selling $selling
 */

$selling->dailySellingCount();
$selling->dailySalesAmount();

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
        <tbody>
        <?php if ($sales) : foreach ($sales as $sale) : ?>
            <tr>
                <td><?= $sale['category_name'] ?></td>
                <td><?= $sale['product_name'] ?></td>
                <td><?= $sale['sell_amount'] ?></td>
                <td><?= $selling->priceFormatter($sale['sell_price']) ?></td>
                <td><?= $selling->setTypePayBadge($sale['sell_amount']) ?></td>
                <td><?= $sale['worker'] ?></td>
                <td><?= $selling->dateParser($sale['created_at']) ?></td>
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
