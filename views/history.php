<?php

/**
 * @var DebtHistory $histories
 */

use app\core\debt\DebtHistory;
use app\core\tools\Formatter;

$debtor_stat = DebtHistory::debtorStat($histories[0]['debtor_id']);
?>

<div class="row mt-3">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Qarzdor: <?= $histories[0]['debtor'] ?></h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
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
                                <td><?= Formatter::setTypePayBadge($history['instant_type_pay'], $history['pay_amount']) ?></td>
                                <td><?= Formatter::priceFormatter($history['pay_amount']) ?></td>
                                <td><?= Formatter::remainingDebt($history['sell_price'], $history['pay_amount']) ?></td>
                                <td><?= Formatter::dateParser($history['created_at']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="card-footer">
                <h3 class="card-title">Qarzdorning umumiy holati</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Barcha qarzi</th>
                            <td>
                                <div class="progress" role="progressbar"
                                     aria-valuemin="0" aria-valuemax="<?= $debtor_stat['total_debt'] ?>">
                                    <div class="progress-bar overflow-visible"
                                         style="width: <?= Formatter::calcPercent($debtor_stat['total_debt'], $debtor_stat['total_debt']) ?>%">
                                        <?= Formatter::priceFormatter($debtor_stat['total_debt']) ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>To'lagan</th>
                            <td>
                                <div class="progress" role="progressbar"
                                     aria-valuemin="0" aria-valuemax="<?= $debtor_stat['total_debt'] ?>">
                                    <div class="progress-bar overflow-visible"
                                         style="width: <?= Formatter::calcPercent($debtor_stat['paid_debt'], $debtor_stat['total_debt']) ?>%"><?= Formatter::priceFormatter($debtor_stat['paid_debt']) ?></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Qolgan</th>
                            <td>
                                <div class="progress" role="progressbar"
                                     aria-valuemin="0" aria-valuemax="<?= $debtor_stat['total_debt'] ?>">
                                    <div class="progress-bar overflow-visible bg-danger"
                                         style="width: <?= Formatter::calcPercent($debtor_stat['remaining'], $debtor_stat['total_debt']) ?>%"><?= Formatter::priceFormatter($debtor_stat['remaining']) ?></div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>