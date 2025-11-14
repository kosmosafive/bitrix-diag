<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Diag;

readonly class TimerDTO
{
    public function __construct(
        protected float $start,
        protected float $end,
        protected float $duration
    ) {
    }

    public function getStart(): float
    {
        return $this->start;
    }

    public function getEnd(): float
    {
        return $this->end;
    }

    public function getDuration(): float
    {
        return $this->duration;
    }

    public static function createFromTimer(Timer $timer): TimerDTO
    {
        return new TimerDTO(
            $timer->getStart(),
            $timer->getEnd(),
            $timer->getDuration()
        );
    }
}
