<?php
$handle = fopen("input.txt", "r");

$requedPassportFields = [
    "byr" => "/^((19[2-9][0-9])|(200[0-2]))$/i",
    "iyr" => "/^(20(1[0-9]|20))$/i",
    "eyr" => "/^(20(2[0-9]|30))$/i",
    "hgt" => "/^(((1[5-8][0-9]|19[0-3])cm)|(59|(6[0-9])|(7[0-6]))in)$/i",
    "hcl" => "/^#[a-f,0-9]{6}$/i",
    "ecl" => "/^(amb|blu|brn|gry|grn|hzl|oth)$/i",
    "pid" => "/^[0-9]{9}$/i",
];

function parsePassportFields($line){
    $passportLine = explode(" ", $line);

    $parsedPassportData = [];
    foreach($passportLine as $data){
        $parseKeyValue = explode(":", $data);
        $passportKey = $parseKeyValue[0];
        $passportValue = $parseKeyValue[1];
        $parsedPassportData[$passportKey] = trim(preg_replace('/\s\s+/', ' ', $passportValue));
    }
    return $parsedPassportData;
}

function passportIsValid($passport, $echo = false){
    global $requedPassportFields;
    $validFieldNum = 0;
    foreach ($requedPassportFields as $fieldKey => $fieldRule) {
        if(array_key_exists($fieldKey, $passport)){
            if($echo){
                echo $fieldKey . ":\t". $passport[$fieldKey] ."=>\t\t". preg_match($fieldRule, $passport[$fieldKey])."\n";
            }
            if(preg_match($fieldRule, $passport[$fieldKey])){
                $validFieldNum++;
            }
        }
    }
    if($echo){
        echo "\n";
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
foreach($passengers as $index => $passenger){
    if(passportIsValid($passenger, $index < 11)){
        $validPassport++;
    }
}

echo "day4b valid passport is $validPassport\n";