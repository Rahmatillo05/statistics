<?php

use app\core\selling\ByCategory;
use app\core\tools\Formatter;

/**
 * @var ByCategory $caty
 */

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
        <tbody class="table-group-divider">
        <?php if ($sales) : foreach ($sales as $sale) : ?>
            <tr>
                <td><?= $sale['category_name'] ?></td>
                <td><?= $caty::setAmountUnit($sale['amount'], $sale['unit']) ?></td>
                <td><?= Formatter::priceFormatter($sale['price']) ?></td>
                <td>
                    <div class="progress" role="progressbar" aria-valuenow="<?= $sale['price'] ?>"
                         aria-valuemin="0" aria-valuemax="<?= $caty->fetchMax() ?>">
                        <div class="progress-bar overflow-visible"
                             style="width: <?= $caty->calcPercent($sale['price']) ?>%"><?= Formatter::priceFormatter($sale['price']) ?></div>
                    </div>
                </td>
            </tr>
        <?php endforeach; else: ?>

        <?php endif; ?>
        </tbody>
    </table>
</div>
