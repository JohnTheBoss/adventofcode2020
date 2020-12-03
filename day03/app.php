<?php

$lines = file(__DIR__ . '/input.txt', FILE_IGNORE_NEW_LINES);

$count = 0;
$col = 0;
foreach($lines as $line){
    if($line[$col] == "#") {
        $count++;
    }
    $col = ($col+3) % strlen($line);
}

echo $count;