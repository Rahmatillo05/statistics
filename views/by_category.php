<?php

use app\core\selling\ByCategory;

$caty = new ByCategory();
$sales = $caty->dailySalesByCategory();

?>

<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Katalog nomi</th>
            <th>Sotish hajmi</th>
            <th>Sotishdan tushgan summa</th>
            <th>Diagramma</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($sales) : foreach ($sales as $sale) : ?>
            <tr>
                <td><?= $sale['category_name'] ?></td>
                <td><?= $caty::setAmountUnit($sale['amount'], $sale['unit']) ?></td>
                <td><?= $caty->priceFormatter($sale['price']) ?></td>
                <td>
                    <div class="progress" role="progressbar" aria-valuenow="<?= $sale['price'] ?>"
                         aria-valuemin="0" aria-valuemax="<?= $caty->fetchMax() ?>">
                        <div class="progress-bar overflow-visible" style="width: <?= $caty->calcPercent($sale['price']) ?>%"><?= $caty->priceFormatter($sale['price']) ?></div>
                    </div>
                </td>
            </tr>
        <?php endforeach; else: ?>

        <?php endif; ?>
        </tbody>
    </table>
</div>
