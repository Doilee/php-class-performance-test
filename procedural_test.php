<?php

echo "Starting test without any classes.. \n";
$start = microtime(true);

$number = 100;
$history = [];

for ($i=0;$i < 10_000_000;$i++) {
	$number = $number * 2.65;
	$number = $number / 2.66;
    $history[] = $number;
}

echo $history[500_000] . "\n";
echo $number . "\n";
echo "execution time took: " .  microtime(true) - $start;
