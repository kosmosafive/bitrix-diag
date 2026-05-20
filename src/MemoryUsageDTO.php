<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Diag;

readonly class MemoryUsageDTO
{
    public function __construct(
        public float $usage,
        public float $peakUsage
    ) {
    }

    public static function createFromMemoryUsage(MemoryUsage $memoryUsage): self
    {
        return new self(
            $memoryUsage->usage,
            $memoryUsage->peakUsage
        );
    }
}