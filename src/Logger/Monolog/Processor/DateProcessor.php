<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Diag\Logger\Monolog\Processor;

use DateTimeInterface;
use Monolog\LogRecord;
use Monolog\Processor\ProcessorInterface;

class DateProcessor implements ProcessorInterface
{
    public function __invoke(LogRecord $record): LogRecord
    {
        $record->extra = array_merge(
            $record->extra,
            [
                'date' => date(DateTimeInterface::ATOM),
            ]
        );

        return $record;
    }
}
