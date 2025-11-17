<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Diag\Logger\Monolog\Handler;

use Monolog\Handler;
use Monolog\JsonSerializableDateTimeImmutable;
use Monolog\Level;
use Monolog\LogRecord;
use Monolog\Utils;

class ChromePHPHandler extends Handler\ChromePHPHandler
{
    public function __construct(
        int|string|Level $level = Level::Debug,
        bool $bubble = true,
        protected int $maxDataLength = 40 * 1024
    ) {
        parent::__construct($level, $bubble);
    }

    protected function send(): void
    {
        if (self::$overflowed || !self::$sendHeaders) {
            return;
        }

        if (!self::$initialized) {
            self::$initialized = true;

            self::$sendHeaders = $this->headersAccepted();
            if (!self::$sendHeaders) {
                return;
            }

            self::$json['request_uri'] = $_SERVER['REQUEST_URI'] ?? '';
        }

        $json = Utils::jsonEncode(self::$json, Utils::DEFAULT_JSON_FLAGS & ~JSON_UNESCAPED_UNICODE, true);
        $data = base64_encode($json);
        if (
            ($this->maxDataLength > 0)
            && (\strlen($data) > $this->maxDataLength)
        ) {
            self::$overflowed = true;

            $record = new LogRecord(
                datetime: new JsonSerializableDateTimeImmutable(true),
                channel: 'monolog',
                level: Level::Warning,
                message: 'Incomplete logs, chrome header size limit reached',
            );
            self::$json['rows'][\count(self::$json['rows']) - 1] = $this->getFormatter()->format($record);
            $json = Utils::jsonEncode(self::$json, Utils::DEFAULT_JSON_FLAGS & ~JSON_UNESCAPED_UNICODE, true);
            $data = base64_encode($json);
        }

        if (trim($data) !== '') {
            $this->sendHeader(static::HEADER_NAME, $data);
        }
    }
}
