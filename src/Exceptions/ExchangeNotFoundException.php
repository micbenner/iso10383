<?php

namespace CipherPixel\ISO10383\Exceptions;

class ExchangeNotFoundException extends \Exception implements ISO10383Exception
{
    public static function withMic(string $mic): self
    {
        return self::withValue('MIC', $mic);
    }

    public static function withValue(string $key, string $value): self
    {
        return new self("Could not find exchange with {$key} of '{$value}'");
    }
}
