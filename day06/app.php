<?php

function getYesGroupAnswersNum($groupAnswers){
    $yesAnsers = [];
    foreach($groupAnswers as $peopleAnswer) {
        foreach(str_split($peopleAnswer) as $answer) {
            $yesAnsers[$answer] = isset($yesAnsers[$answer]) ? $yesAnsers[$answer]+1 : 1;
        }
    }

    $allYes = 0;
    foreach ($yesAnsers as $answer) {
        if($answer == count($groupAnswers)){
            $allYes++;
        }
    }

    return [count($yesAnsers), $allYes];
}

$handle = fopen("input.txt", "r");
if ($handle) {
    $groupAnswers = [];
    $sumYes = 0;
    $allYes = 0;
    while (($line = fgets($handle)) !== false) {
        if($line == "\r\n"){
            $tmp = getYesGroupAnswersNum($groupAnswers);
            $sumYes +=  $tmp[0];
            $allYes += $tmp[1];
            $groupAnswers = [];
        } else {
           $groupAnswers[] = str_replace("\r\n", '', $line);
        }
    }
    fclose($handle);

    $tmp = getYesGroupAnswersNum($groupAnswers);
    $sumYes +=  $tmp[0];
    $allYes += $tmp[1];
    $groupAnswers = []; 
}

echo "day 06a is ". $sumYes . "\n";
echo "day 06b is ". $allYes . "\n";