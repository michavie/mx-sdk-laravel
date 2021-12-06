<?php

namespace Superciety\ElrondSdk\Utils;

class Encoder
{
    public static function toHex(string|int $value, ?int $bytes = null): string
    {
        if (is_string($value)) {
            return bin2hex(trim($value));
        }

        $bytes = $bytes ?? $value > 256 ? 2 : 1;

        return str_pad(dechex($value), $bytes * 2, '0', STR_PAD_LEFT);
    }
}
