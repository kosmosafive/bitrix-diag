<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Diag\Formatter;

use Webmozart\Assert\Assert;

final readonly class SizeFormatter implements SizeFormatterInterface
{
    public function format(float|int|string $size): string
    {
        Assert::numeric($size);

        $size = (float) $size;
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        $power = ($size > 0) ? floor(log($size, 1024)) : 0;
        return number_format($size / (1024 ** $power), 2, '.', ',') . ' ' . $units[$power];
    }
}