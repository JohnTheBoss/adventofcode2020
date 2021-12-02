<?php

namespace AOC;

interface DalyTask
{
    public function answers(): string;

    public function execute();
}