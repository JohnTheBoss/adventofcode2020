<?php

namespace AOC\Presenter;

class NumberPresenter implements PresenterInterface
{

    public function parse($data)
    {
        return intval($data);
    }
}