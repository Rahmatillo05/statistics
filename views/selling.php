<?php

use app\core\selling\Selling;

$selling = new Selling();

echo "<pre>";
print_r($selling->daily(["category.category_name", 'sell_amount']));