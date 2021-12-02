<?php

namespace AOC\Reader;

interface ReaderInterface
{
    public function first(): void;

    public function current();

    public function next($stepSize = 1): void;

    public function isEnd(): bool;

    public function close(): void;
}