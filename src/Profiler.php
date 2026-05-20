<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Diag;

class Profiler
{
    protected(set) Timer $timer;
    protected(set) MemoryUsage $memoryUsage;

    public function __construct()
    {
        $this->timer = new Timer();
        $this->memoryUsage = new MemoryUsage();
    }

    public function start(): static
    {
        $this->timer->start();
        $this->memoryUsage->start();

        return $this;
    }

    public function end(): static
    {
        $this->timer->end();
        $this->memoryUsage->end();

        return $this;
    }
}