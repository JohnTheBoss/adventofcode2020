<?php

function passwordIsValid($min, $max, $search, $password){
    $passwordInChar = str_split($password);
    $count = 0;
    foreach ($passwordInChar as $char) {
        if($char == $search){
            $count++;
        }
    }

    return $count >= $min && $count <= $max; 
}

function passwordIsValid2($min, $max, $search, $password){
    $passwordInChar = str_split($password);
    
    return $passwordInChar[$min-1] == $search && $passwordInChar[$max-1] != $search || $passwordInChar[$min-1] != $search  && $passwordInChar[$max-1] == $search;
}

$lines = file(__DIR__ . '/input.txt', FILE_IGNORE_NEW_LINES);
$count = 0;
foreach ($lines as $line) {
    $data = explode(': ', $line);
    $searchInterval = explode(' ', $data[0])[0];
    $searchMin = intval(explode('-',$searchInterval)[0]);
    $searchMax = intval(explode('-',$searchInterval)[1]);
    $searchChar = explode(' ', $data[0])[1];

    echo $searchMin ."\t". $searchMax. "\t" . $searchChar."\t". $data[1]. "\n";
    if(passwordIsValid2($searchMin, $searchMax, $searchChar, $data[1])){
        $count++;
    }
}

echo "$count password valid";