<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Diag;

class Timer
{
    protected ?float $start = null;

    protected ?float $end = null;

    public function __construct()
    {
        $this->start = microtime(true);
    }

    public function start(): Timer
    {
        $this->start = microtime(true);

        return $this;
    }

    public function end(): Timer
    {
        $this->end = microtime(true);

        return $this;
    }

    public function getStart(): ?float
    {
        return $this->start;
    }

    public function getEnd(): ?float
    {
        return $this->end;
    }

    public function getDuration(): float
    {
        if (!$this->end) {
            $this->end();
        }

        return $this->end - $this->start;
    }
}
