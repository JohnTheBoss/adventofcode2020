<?php
$handle = fopen("input.txt", "r");

$requedPassportFields = ["byr", "iyr", "eyr", "hgt", "hcl", "ecl", "pid"];

function parsePassportFields($line){
    $passportLine = explode(" ", $line);

    $parsedPassportData = [];
    foreach($passportLine as $data){
        $parseKeyValue = explode(":", $data);
        $passportKey = $parseKeyValue[0];
        $passportValue = $parseKeyValue[1];
        $parsedPassportData[$passportKey] = $passportValue;
    }
    return $parsedPassportData;
}

function passportIsValid($passport){
    global $requedPassportFields;
    $validFieldNum = 0;
    foreach ($requedPassportFields as $requedFieldName) {
        if(array_key_exists($requedFieldName, $passport)){
            $validFieldNum++;
        }
    }
    return $validFieldNum == count($requedPassportFields);
}

$passengers = [];
$passengerID = 0;
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        if($line == "\r\n"){ 
            $passengerID++;
        } else {
            $tmp = isset($passengers[$passengerID]) ? $passengers[$passengerID] : []; 
            $passengers[$passengerID] = array_merge($tmp, parsePassportFields($line));
        }
    }
    fclose($handle);
}

$validPassport = 0;
foreach($passengers as $passenger){
    if(passportIsValid($passenger)){
        $validPassport++;
    }
}

echo "day4a valid passport is $validPassport\n";