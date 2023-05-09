<?php

/**
 * @var array $sorting_dates
 * @var \app\core\money\Cash $cash
 * @var \app\core\money\Plastic $plastic
 * @var Selling $selling
 * @var ByCategory $caty
 * @var DebtHistory $debt_history
 * @var \app\core\money\Debt $debt
 */

use app\core\debt\DebtHistory;
use app\core\money\Cash;
use app\core\money\Plastic;
use app\core\selling\ByCategory;
use app\core\selling\Selling;
use app\core\View;

?>

<div class="row mt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="div">
                        <h3 class="card-title">Umumiy holat</h3>
                        <span class="text-mute">Odatiy holatda bugungi kundagi ma'lumotlar aks etadi</span>
                    </div>
                    <form action="/sorting">
                        <h4>Sana bo'yicha ko'rish:</h4>
                        <label>
                            Boshlanish sanasi
                            <input type="date" name="Sorting[start]" value="<?= $sorting_dates['start'] ?? '' ?>"
                                   class="form-control">
                        </label>
                        <label>
                            Tugash sanasi
                            <input type="date" class="form-control" name="Sorting[end]" dataformatas="dd/mm/yyyy"
                                   value="<?= $sorting_dates['end'] ?? '' ?>">
                        </label>
                        <button type="submit" class="btn btn-primary">Ko'rish</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <?= View::staticRender('table_stat', compact('cash', 'plastic', 'debt')) ?>
            </div>
        </div>
        <div class="card mt-sm-3">
            <div class="card-header">
                <h3 class="card-title">Sotish bo'yicha</h3>
                <span class="text-mute">Odatiy holatda bugungi kundagi ma'lumotlar aks etadi</span>
            </div>
            <div class="card-body">
                <div class="mb-md-3">
                    <h3 class="card-title">Kataloglar bo'yicha</h3>
                    <?= View::staticRender('by_category', compact('caty')) ?>
                </div>
                <div class="mb-md-3">
                    <h3 class="card-title">Qarzdorliklar</h3>
                    <?= View::staticRender('debt_history', compact('debt_history')) ?>
                </div>
                <div class="mt-3">
                    <h3 class="card-title">Barcha sotish qaydlari</h3>
                    <?= View::staticRender('selling', compact('selling')) ?>
                </div>
            </div>
        </div>
    </div>
</div>