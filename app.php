<?php

require_once __DIR__ . '/vendor/autoload.php';

if (count($argv) !== 2) {
    echo 'Please use this syntax \'php app.php dayNumber\'!' . PHP_EOL;
    return;
}

$dalyTask = \AOC\Days\DayFactory::getDayClass($argv[1]);
$dalyTask->execute();

$answers = $dalyTask->answers();

echo '==========' . PHP_EOL;
echo $answers;
echo '==========' . PHP_EOL;