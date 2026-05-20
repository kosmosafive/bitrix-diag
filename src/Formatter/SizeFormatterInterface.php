<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Diag\Formatter;

interface SizeFormatterInterface
{
    public function format(float|int|string $size): string;
}
