<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Diag\Logger;

use Psr\Log;

class LoggerFactory
{
    use CreateLoggerTrait;

    public static function create(string $loggerName, bool $useDefault = true): Log\LoggerInterface
    {
        return static::createLogger($loggerName, $useDefault);
    }
}
