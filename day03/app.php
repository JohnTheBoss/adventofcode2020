<?php

$lines = file(__DIR__ . '/input.txt', FILE_IGNORE_NEW_LINES);

$slopeTypes = [
    "1-1" => [
        "right" => 1,
        "down" => 1,
        "count" => 0,
        "col" => 0,
    ],
    "3-1" => [
        "right" => 3,
        "down" => 1,
        "count" => 0,
        "col" => 0,
    ],
    "5-1" => [
        "right" => 5,
        "down" => 1,
        "count" => 0,
        "col" => 0,
    ],
    "7-1" => [
        "right" => 7,
        "down" => 1,
        "count" => 0,
        "col" => 0,
    ],
    "1-2" => [
        "right" => 1,
        "down" => 2,
        "count" => 0,
        "col" => 0,
    ],
];

function checkTree($line, $row, &$slope){
    if($row % $slope['down'] == 0){
        if($line[$slope['col']] == "#") {
            $slope['count']++;
        }
        $slope['col'] = ($slope['col'] + $slope['right']) % strlen($line);
    }
}

foreach($lines as $row => $line){
    foreach($slopeTypes as $method => &$slope){
        checkTree($line, $row, $slope);
    }
}

$multiply = 1;
foreach($slopeTypes as $method => &$slope){
    echo $method . " is " . $slope['count'] . "\n";
    $multiply *= $slope['count'];
}

echo $multiply;