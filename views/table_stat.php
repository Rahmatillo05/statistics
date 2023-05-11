<?php

use app\core\money\Cash;
use app\core\money\Plastic;
use app\core\tools\Formatter;

/**
 * @var \app\core\money\Cash $cash
 * @var \app\core\money\Plastic $plastic
 * @var \app\core\money\Debt $debt
 * @var \app\core\money\Statistics $statistics
 */
$daily_debt = $debt->dailyNewDebt();
$paid = $debt->paymentHistory();

?>
<div class="table-responsive mb-5">
    <table class="table">
        <tr class="text-center">
            <th colspan="8"><h5>Umumiy statistika</h5></th>
        </tr>
        <tbody class="table-group-divider">
        <tr>
            <th class="table-info">Mahsulot sotishdan</th>
            <th class="table-warning">Mahsulotlarga ketgan summa</th>
            <th class="table-secondary">Qarzlarni to'lashdan</th>
            <th class="table-primary">Foyda</th>
            <th class="table-danger">Boshqa harajatlar</th>
            <th class="table-danger">Plastik solig'i</th>
            <th class="table-danger">To'lanmagan qarzlar</th>
            <td class="table-success">Sof foyda</td>
        </tr>
        <tr>
            <td class="table-info"><?= Formatter::priceFormatter($statistics->allSum()) ?></td>
            <td class="table-warning"><?= Formatter::priceFormatter($statistics->productSum()) ?></td>
            <td class="table-secondary"><?= Formatter::priceFormatter($statistics->paid()) ?></td>
            <td class="table-primary"><?= Formatter::priceFormatter($statistics->profit()) ?></td>
            <td class="table-danger"><?= Formatter::priceFormatter($statistics->otherSpent()) ?></td>
            <td class="table-danger"><?= Formatter::priceFormatter($plastic->taxAmount()) ?></td>
            <td class="table-danger"><?= Formatter::priceFormatter($statistics->noPaidDebt()) ?></td>
            <td class="table-success"><?= Formatter::priceFormatter($statistics->netProfit($plastic->taxAmount())) ?></td>
        </tr>
        </tbody>

    </table>
</div>

<div class="table-responsive">
    <table class="table">
        <tr class="text-center">
            <th colspan="6"><h5>Naqd pul</h5></th>
        </tr>
        <tbody class="table-group-divider">
        <tr>
            <th>Sotishdan</th>
            <th>Aralash sotish</th>
            <th>Qarzni to'lash</th>
            <th>Qarzga sotilgandagi to'lov</th>
            <th colspan="2"><h6>Umumiy</h6></th>
        </tr>
        <tr>
            <td><?= Formatter::priceFormatter($cash->dailySelling()) ?></td>
            <td><?= Formatter::priceFormatter($cash->dailyMixSelling()) ?></td>
            <td><?= Formatter::priceFormatter($cash->dailyPaidDebt()) ?></td>
            <td><?= Formatter::priceFormatter($cash->dailyInstantPayment()) ?></td>
            <td colspan="2"><?= Formatter::priceFormatter($cash->dailyTotalCash()) ?></td>
        </tr>
        </tbody>

    </table>
</div>
<div class="table-responsive">
    <table class="table mt-3">
        <tr class="text-center">
            <th colspan="6"><h5>Plastikka</h5></th>
        </tr>
        <tbody class="table-group-divider">
        <tr>
            <th>Sotishdan</th>
            <th>Aralash sotish</th>
            <th>Qarzni to'lash</th>
            <th>Qarzga sotilgandagi to'lov</th>
            <th colspan="2"><h6>Umumiy</h6></th>
        </tr>
        <tr>
            <td><?= Formatter::priceFormatter($plastic->dailySelling()) ?></td>
            <td><?= Formatter::priceFormatter($plastic->dailyMixSelling()) ?></td>
            <td><?= Formatter::priceFormatter($plastic->dailyPaidDebt()) ?></td>
            <td><?= Formatter::priceFormatter($plastic->dailyInstantPayment()) ?></td>
            <td colspan="2"><?= Formatter::priceFormatter($plastic->dailyTotalCash()) ?></td>
        </tr>
        </tbody>
    </table>
</div>
<div class="table-responsive">
    <table class="table mt-3 table-bordered">
        <tr class="text-center">
            <th colspan="6"><h5>Qarzga</h5></th>
        </tr>
        <tbody class="table-group-divider">
        <tr>
            <th>Yangi qarzdorliklar</th>
            <th>Joyida to'landi</th>
            <th>Qolgan</th>
            <th>Avvalgi qarzlarni to'lash</th>
        </tr>
        <tr>
            <td><?= Formatter::priceFormatter($daily_debt['debt']) ?></td>
            <td><?= Formatter::priceFormatter($daily_debt['paid']) ?></td>
            <td><?= Formatter::priceFormatter($daily_debt['remaining']) ?></td>
            <td><?= Formatter::priceFormatter($paid) ?></td>
        </tr>
        </tbody>
    </table>
</div>

