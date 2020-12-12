<?php

$lines = file(__DIR__ . '/input.txt', FILE_IGNORE_NEW_LINES);

function parseBag($line)
{
    $bagSplit = explode(' bags contain', $line);
    $name = $bagSplit[0];
    $sourceContains = explode(', ', trim($bagSplit[1]));
    $contains = [];
    foreach ($sourceContains as $contain) {
        if ($contain !== "no other bags.") {
            $spitContain = explode(' ', $contain);
            $contains[] = [
                "name" => $spitContain[1] . " " . $spitContain[2],
                "number" => $spitContain[0],
            ];
        }
    }

    return [
        "name" => $name,
        "contain" => $contains,
    ];
}

$bags = [];
foreach ($lines as $line) {
    $bag = parseBag($line);
    $bags[$bag['name']] = $bag['contain'];
}

function unpackBag($bagType)
{
    global $bags;
    $allBags = [];

    foreach ($bags[$bagType] as $bag) {
        $allBags[] = $bag['name'];
        $allBags = array_merge($allBags, unpackBag($bag['name']));
    }

    return $allBags;
}

$unpackedBags = [];
foreach ($bags as $bagType => $bagValue) {
    $unpackedBags[$bagType] = unpackBag($bagType);
}

$bagColorContainsShinyGold = [];
foreach ($unpackedBags as $bagColor => $bag) {
    if (in_array("shiny gold", $bag)) {
        if (!in_array($bagColor, $bagColorContainsShinyGold)) {
            $bagColorContainsShinyGold[] = $bagColor;
        }
    }
}

echo "7a: " . count($bagColorContainsShinyGold) . "\n";