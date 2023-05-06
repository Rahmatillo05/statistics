<?php

/**
 * @var array $sorting_dates
 */

?>

<div class="row mt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Umumiy holat</h3>
                    <form action="/sorting">
                        <h4>Sana bo'yicha ko'rish:</h4>
                        <label>
                            Boshlanish sanasi
                            <input type="date" name="Sorting[start]" value="<?= $sorting_dates['start'] ?? '' ?>"
                                   class="form-control">
                        </label>
                        <label>
                            Tugash sanasi
                            <input type="date" class="form-control" name="Sorting[end]" dataformatas="dd/mm/yyyy" value="<?= $sorting_dates['end'] ?? '' ?>">
                        </label>
                        <button type="submit" class="btn btn-primary">Ko'rish</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="table table-responsive">
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
                            <!--            Data                -->
                        </tr>
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
                            <!-- data -->
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>