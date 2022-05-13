<?php

namespace Superciety\ElrondSdk\Domain;

use Exception;

/**
 * @deprecated Use TokenPayment intstead
 */
final class Token
{
    const SuperTokenId = 'SUPER-507aa6';
    const SuperTokenIdTestnet = 'XSUPER-0ad9d6';
    const SuperTokenIdDevnet = 'DSUPER-9af8df';

    public function __construct(
        public string $identifier,
        public string $name,
        public int $decimals,
    ) {
    }

    public static function egld(): static
    {
        return new static(identifier: 'EGLD', name: 'eGold', decimals: 18);
    }

    public static function super(): static
    {
        $tokenId = match (config('elrond.chain_id')) {
            'D' => static::SuperTokenIdDevnet,
            'T' => static::SuperTokenIdTestnet,
            '1' => static::SuperTokenId,
            default => throw new Exception('invalid chain id'),
        };

        return new static(identifier: $tokenId, name: 'SUPER', decimals: 18);
    }
}
