<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Diag\Logger\Monolog;

use Bitrix\Main\ArgumentNullException;
use Bitrix\Main\Diag\ExceptionHandlerLog;

class ExceptionLogger extends ExceptionHandlerLog
{
    protected \Monolog\Logger $logger;

    public function write($exception, $logType): void
    {
        $context = [
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTrace(),
            'logType' => $logType,
        ];

        $this->logger->emergency($exception->getMessage(), $context);
    }

    /**
     * @throws ArgumentNullException
     */
    public function initialize(array $options): void
    {
        $logger = $options['logger'];
        if (!($logger instanceof \Monolog\Logger)) {
            throw new ArgumentNullException('logger');
        }

        $this->logger = $logger;
    }
}
