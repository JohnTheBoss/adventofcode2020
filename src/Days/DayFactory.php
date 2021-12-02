<?php

namespace AOC\Days;

use AOC\DalyTask;

class DayFactory
{
    public static function getDayClass($dayIndex): DalyTask
    {
        $dayIndex = sprintf("%02d", $dayIndex);

        $className = '\AOC\Days\Day' . $dayIndex;

        if (class_exists($className)) {
            return new $className();
        }

        throw new \Exception('The ' . $className . ' doesn\'t exist!');
    }
}