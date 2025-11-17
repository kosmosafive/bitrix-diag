<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Diag\Logger\Monolog\Processor;

use Monolog\LogRecord;
use Monolog\Processor\ProcessorInterface;

class LevelProcessor implements ProcessorInterface
{
    public function __invoke(LogRecord $record): LogRecord
    {
        $record->extra = array_merge(
            $record->extra,
            [
                'level' => strtoupper($record->level->getName()),
            ]
        );

        return $record;
    }
}
