<?php

namespace AOC;

class Answers
{
    public $first;

    public $second;

    public function getAnswers()
    {
        return 'The first answer is: ' . $this->first . "\n\n" . 'The second answer is: ' . $this->second . "\n";
    }
}