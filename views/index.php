<?php

/**
 * @var array $sorting_dates
 */

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
                <?= View::staticRender('table_stat') ?>
            </div>
        </div>
        <div class="card mt-sm-3">
            <div class="card-header">
                <h3 class="card-title">Sotish bo'yicha</h3>
                <span class="text-mute">Odatiy holatda bugungi kundagi ma'lumotlar aks etadi</span>
            </div>
            <div class="card-body">
                <?= View::staticRender('selling') ?>
            </div>
        </div>
    </div>
</div>