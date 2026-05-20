<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Diag;

final readonly class TimerDTO
{
    public function __construct(
        public float $start,
        public float $end,
        public float $duration
    ) {
    }

    public static function createFromTimer(Timer $timer): self
    {
        return new self(
            $timer->start,
            $timer->end,
            $timer->duration
        );
    }
}
