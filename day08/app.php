<?php

function parseLine($line)
{
    $split = explode(' ', $line);
    return [
        "operate" => $split[0],
        "arg" => (int)$split[1],
    ];
}

$lines = file(__DIR__ . '/input.txt', FILE_IGNORE_NEW_LINES);
$program = [];
foreach ($lines as $line) {
    $program[] = parseLine($line);
}

function nextStep($currentStep, $accumulator, $operate, $agv)
{
    $nextStep = $currentStep;
    $jump = false;

    switch ($operate) {
        case "nop":
            $nextStep += 1;
            break;
        case "acc":
            $nextStep += 1;
            $accumulator += $agv;
            break;
        case "jmp":
            $nextStep += $agv;
            break;
    }

    return [
        'next' => $nextStep,
        'current' => $currentStep,
        'acc' => $accumulator,
        'jump' => $jump,
    ];
}

function runProgram($program)
{
    $accumulator = 0;
    $accumulator8a = 0;
    $commandIndex = 0;

    $lineHistory = [];

    while (!in_array($commandIndex, $lineHistory)) {
        $lineHistory[] = $commandIndex;
        $run = nextStep($commandIndex, $accumulator, $program[$commandIndex]['operate'], $program[$commandIndex]['arg']);
        $commandIndex = $run['next'];
        $accumulator = $run['acc'];
        // echo $commandIndex . ".\t" . $program[$commandIndex]['operate'] . " " . $program[$commandIndex]['arg'] . "\t" . $accumulator . "\n";
    }

    $accumulator8a = $accumulator;
    echo "8a acc is: " . $accumulator8a . "\n";
}

runProgram($program);