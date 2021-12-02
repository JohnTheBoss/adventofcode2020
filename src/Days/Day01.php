<?php

namespace AOC\Days;

use AOC\Presenter\NumberPresenter;
use AOC\Presenter\PresenterInterface;
use AOC\Reader\FileReader;

class Day01 extends AbstractDay
{
    private PresenterInterface $presenter;

    private const INPUT = __DIR__ . '/../../inputs/day01.txt';

    public function __construct()
    {
        parent::__construct();

        $this->presenter = new NumberPresenter();
    }

    public function execute()
    {
        $presenter = new NumberPresenter();
        $this->answers->first = $this->firstTask($presenter);
        $this->answers->second = $this->secondTask($presenter);
    }

    private function firstTask($presenter)
    {
        $reader = new FileReader(self::INPUT, $presenter);
        $reader->first();

        $incrementNumber = 0;
        while (!$reader->isEnd()) {
            $first = $reader->current();

            $reader->next();
            $second = $reader->current();

            if ($first < $second) {
                $incrementNumber++;
            }
        }

        return $incrementNumber;
    }

    private function secondTask($presenter)
    {
        $reader = new FileReader(self::INPUT, $presenter);
        $reader->first();

        $incrementNumber = 0;

        $sum = 0;
        $numberSets = [];

        $numberSets[] = $reader->current();
        $reader->next();
        $numberSets[] = $reader->current();
        $reader->next();
        $numberSets[] = $reader->current();

        while (!$reader->isEnd()) {
            $currentSum = array_sum($numberSets);

            if ($sum > 0 && $sum < $currentSum) {
                $incrementNumber++;
            }

            $sum = $currentSum;

            array_shift($numberSets);

            $reader->next();
            $numberSets[] = $reader->current();
        }

        return $incrementNumber;
    }

}