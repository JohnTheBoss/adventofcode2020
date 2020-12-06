<?php

function getYesGroupAnswersNum($groupAnswers){
    $yesAnsers = [];
    foreach($groupAnswers as $peopleAnswer) {
        foreach(str_split($peopleAnswer) as $answer) {
            $yesAnsers[$answer] = isset($yesAnsers[$answer]) ? $yesAnsers[$answer]+1 : 1;
        }
    }

    return count($yesAnsers);
}

$handle = fopen("input.txt", "r");
if ($handle) {
    $groupAnswers = [];
    $sumYes = 0;
    while (($line = fgets($handle)) !== false) {
        if($line == "\r\n"){
            $sumYes +=  getYesGroupAnswersNum($groupAnswers);
            $groupAnswers = [];
        } else {
           $groupAnswers[] = str_replace("\r\n", '', $line);
        }
    }
    fclose($handle);

    $sumYes +=  getYesGroupAnswersNum($groupAnswers);
    $groupAnswers = []; 
}

echo "day 06a is ". $sumYes . "\n";