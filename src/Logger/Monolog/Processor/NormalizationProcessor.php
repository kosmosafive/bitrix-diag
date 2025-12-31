<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Diag\Logger\Monolog\Processor;

use Monolog\Processor\ProcessorInterface;
use Symfony\Component\Serializer\Serializer;
use Monolog\LogRecord;
use Throwable;

class NormalizationProcessor implements ProcessorInterface
{
    public function __construct(
        protected string $serializerFactoryClass
    ) {
    }

    public function __invoke(LogRecord $record)
    {
        try {

            if (!class_exists($this->serializerFactoryClass)) {
                return $record;
            }

            /**
             * @var Serializer $serializer
             */
            $serializer = $this->serializerFactoryClass::create();

            return $record->with(...['context' => $serializer->normalize($record->context)]);
        } catch (Throwable) {

        }

        return $record;
    }
}