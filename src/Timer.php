<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Diag;

final class Timer
{
    private(set) ?float $start = null;

    private(set) ?float $end = null;

    public float $duration {
        get {
            if (!$this->end) {
                $this->end();
            }

            return $this->end - $this->start;
        }
    }


    public function __construct()
    {
        $this->start = microtime(true);
    }

    public function start(): self
    {
        $this->start = microtime(true);

        return $this;
    }

    public function end(): self
    {
        $this->end = microtime(true);

        return $this;
    }
}
