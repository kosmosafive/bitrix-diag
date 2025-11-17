<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Diag\Logger\Monolog\Processor;

use Bitrix\Main\Engine\CurrentUser;
use Monolog\LogRecord;
use Monolog\Processor\ProcessorInterface;

class UserIdProcessor implements ProcessorInterface
{
    public function __invoke(LogRecord $record): LogRecord
    {
        $record->extra = array_merge(
            $record->extra,
            [
                'userId' => (int) CurrentUser::get()?->getId(),
            ]
        );

        return $record;
    }
}
