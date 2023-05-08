<?php

use app\core\Cash;
use app\core\Plastic;
use app\core\tools\Formatter;

/**
 * @var Cash $cash
 * @var Plastic $plastc
 */

?>
<div class="table-responsive">
    <table class="table">
        <tr class="text-center">
            <th colspan="6"><h5>Naqd pul</h5></th>
        </tr>
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
    </table>
</div>
<div class="table-responsive">
    <table class="table mt-3">
        <tr class="text-center">
            <th colspan="6"><h5>Plastikka</h5></th>
        </tr>
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
    </table>
</div>

