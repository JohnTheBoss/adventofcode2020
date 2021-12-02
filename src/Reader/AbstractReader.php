<?php

namespace AOC\Reader;

use AOC\Presenter\PresenterInterface;

abstract class AbstractReader implements ReaderInterface
{
    protected $fileName;

    protected PresenterInterface $presenter;

    public function __construct($fileName, PresenterInterface $presenter = null)
    {
        $this->fileName = $fileName;
        $this->presenter = $presenter;
    }
}