<?php

function getRowNumber($where, $start, $end){
    switch ($where) {
        case "F":
        case "L":
            $end = floor(($start + $end)/2);
        break;
        case "B":
        case "R":
            $start = ceil(($start + $end)/2);
        break;
    }
    return [$start, $end];
}

function parseSeat($seat){
    $rowStart = 0;
    $rowEnd = 127;
    $colStart = 0;
    $colEnd = 7;
    foreach(str_split($seat) as $index => $place){
        if($index < 7){
            $tmp = getRowNumber($place, $rowStart, $rowEnd);
            $rowStart = $tmp[0];
            $rowEnd = $tmp[1];
        } else {
            $tmp = getRowNumber($place, $colStart, $colEnd);
            $colStart = $tmp[0];
            $colEnd = $tmp[1];
        }
    }
    return ["row" => $rowStart, "col" => $colStart, "seatId" => $rowStart * 8 + $colStart];
}

$lines = file(__DIR__ . '/input.txt', FILE_IGNORE_NEW_LINES);
$maxSeatID = 0;
foreach($lines as $seat){
    $seatId= parseSeat($seat)['seatId'];
    if($maxSeatID < $seatId){
        $maxSeatID = $seatId;
    }
}

echo "5a: " . $maxSeatID . "\n"; 