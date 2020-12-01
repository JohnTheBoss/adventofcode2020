<?php

$handle = fopen("input.txt", "r");
$numbers = [];

$i = 0;
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $numbers[] = intval($line);
    }
    fclose($handle);
}

for($start = 0; $start < count($numbers); $start++){
    for($center = $start+1; $center<count($numbers); $center++){
        for($end = $center+1; $end < count($numbers); $end++){
            // echo $numbers[$start] + $numbers[$center] + $numbers[$end]. "\n";
            if($numbers[$start] + $numbers[$center] + $numbers[$end] == 2020){
                echo "\n\n".$numbers[$start] * $numbers[$center] * $numbers[$end]."\n";
                die("Find!");
            }
        }
    }
}