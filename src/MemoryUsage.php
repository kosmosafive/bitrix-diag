<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Diag;

final class MemoryUsage
{
    private(set) float $startUsage;
    private(set) ?float $endUsage = null;
    private(set) ?float $peakUsage = null;

    public float $usage {
        get {
            if (!$this->endUsage) {
                $this->end();
            }

            return $this->endUsage - $this->startUsage;
        }
    }

    public function __construct()
    {
        $this->startUsage = memory_get_usage();
    }

    public function start(): self
    {
        $this->startUsage = memory_get_usage();

        return $this;
    }

    public function end(): self
    {
        $this->endUsage = memory_get_usage();
        $this->peakUsage = memory_get_peak_usage();

        return $this;
    }
}