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
    $commandIndex = 0;
    $lineHistory = [];
    $loopError = false;

    while (!in_array($commandIndex, $lineHistory) && $commandIndex < count($program)) {
        $lineHistory[] = $commandIndex;
        $run = nextStep($commandIndex, $accumulator, $program[$commandIndex]['operate'], $program[$commandIndex]['arg']);
        $commandIndex = $run['next'];
        $accumulator = $run['acc'];
        // echo $commandIndex . ".\t" . $program[$commandIndex]['operate'] . " " . $program[$commandIndex]['arg'] . "\t" . $accumulator . "\n";
    }

    if (in_array($commandIndex, $lineHistory) || $commandIndex > count($program)) {
        $loopError = true;
    }

    return [$loopError, $accumulator];
}

echo "8a acc is: " . runProgram($program)[1] . "\n";

function fixProgram($program)
{
    $testLine = 0;
    $accumulator = 0;

    $loopError = true;
    while ($loopError) {
        $testProgram = $program;

        if ($testProgram[$testLine]['operate'] == 'jmp') {
            $testProgram[$testLine]['operate'] = "nop";
        } else if ($testProgram[$testLine]['operate'] == 'nop') {
            $testProgram[$testLine]['operate'] = 'jmp';
        }

        $run = runProgram($testProgram);
        $loopError = $run[0];
        $accumulator = $run[1];

        $testLine++;
    }

    return $accumulator;
}

echo "8b acc is: " . fixProgram($program) . "\n";