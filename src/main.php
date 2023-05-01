<?php

use CodeCrafter\ControllerStatistics\Cash;

$cash = new Cash();

echo $cash->dailySelling()."<br>";
echo $cash->dailyMixSelling()."<br>";
echo $cash->dailyPayment()."<br>";
echo $cash->dailyPaidDebt()."<br>";
