<?php

$handle = fopen("input.txt", "r");
$numbers = [];

if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $numbers[] = intval($line);
    }
    fclose($handle);
}

for($start = 0; $start < count($numbers); $start++){
    for($end = $start+1; $end < count($numbers); $end++){
        // echo $numbers[$start] + $numbers[$end]. "\n";
        if($numbers[$start] + $numbers[$end] == 2020){
            echo "\n\n".$numbers[$start] * $numbers[$end]."\n";
            die("find!");
        }
    }
}