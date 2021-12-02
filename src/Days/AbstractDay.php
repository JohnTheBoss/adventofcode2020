<?php

namespace AOC\Days;

use AOC\Answers;
use AOC\DalyTask;

abstract class AbstractDay implements DalyTask
{
    protected Answers $answers;

    public function __construct()
    {
        $this->answers = new Answers();

        $this->answers->first = 'TODO';
        $this->answers->second = 'TODO';
    }

    public function answers(): string
    {
        return $this->answers->getAnswers();
    }

}