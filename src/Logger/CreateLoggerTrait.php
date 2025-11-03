<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Diag\Logger;

use Bitrix\Main\Diag;
use Psr\Log;

trait CreateLoggerTrait
{
    protected static function createLogger(string $loggerName, bool $useDefault = true): Log\LoggerInterface
    {
        $logger = Diag\Logger::create($loggerName);

        if (!$logger && $useDefault) {
            $logger = Diag\Logger::create('default');
        }

        return $logger ?: new Log\NullLogger();
    }

}
