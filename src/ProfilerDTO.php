<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Diag;

readonly class ProfilerDTO
{
    public function __construct(
        public TimerDTO $timer,
        public MemoryUsageDTO $memoryUsage
    ) {
    }

    public static function createFromProfiler(Profiler $profiler): self
    {
        return new self(
            TimerDTO::createFromTimer($profiler->timer),
            MemoryUsageDTO::createFromMemoryUsage($profiler->memoryUsage)
        );
    }
}