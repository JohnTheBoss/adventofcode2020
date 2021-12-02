<?php

namespace AOC\Reader;

class FileReader extends AbstractReader
{
    private $stream;

    private string $current;

    private bool $isEnd = false;

    public function first(): void
    {
        $this->stream = fopen($this->fileName, 'r');
        $this->read();
    }

    public function current()
    {
        if ($this->presenter !== null) {
            return $this->presenter->parse($this->current);
        }

        return $this->current;
    }

    public function next($stepSize = 1): void
    {
        for ($i = 0; $i < $stepSize; $i++) {
            $this->read();
        }
    }

    public function isEnd(): bool
    {
        return $this->isEnd;
    }

    private function read()
    {
        $raw = fgets($this->stream);
        if ($raw !== false) {
            $this->current = $raw;
            return;
        }
        $this->isEnd = true;
    }

    public function close(): void
    {
        fclose($this->stream);
    }
}