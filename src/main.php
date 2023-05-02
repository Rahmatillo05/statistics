<?php

use CodeCrafter\ControllerStatistics\Cash;

$cash = new Cash();

echo $cash->dailySelling()."<br>";
echo $cash->dailyMixSelling()."<br>";
echo $cash->dailyInstantPayment()."<br>";
echo $cash->dailyPaidDebt()."<br>";
echo $cash->dailyTotalCash()."<br>";