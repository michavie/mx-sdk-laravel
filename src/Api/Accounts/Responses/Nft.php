<?php

namespace Superciety\ElrondSdk\Api\Accounts\Responses;

use Illuminate\Support\Str;
use Superciety\ElrondSdk\Api\ResponseBase;

class Nft extends ResponseBase
{
    const NonFungibleESDT = 'NonFungibleESDT';
    const SemiFungibleESDT = 'SemiFungibleESDT';
    const MetaESDT = 'MetaESDT';

    public function __construct(
        public string $identifier,
        public string $collection,
        public string $attributes,
        public int $nonce,
        public string $type,
        public string $name,
        public string $creator,
        public string $ticker,
        public ?int $royalties = null,
        public ?string $url = null,
        public ?string $thumbnailUrl = null,
    ) {
    }

    public function getTags(): array
    {
        preg_match('/tags:(?<tags>[\w\s\,]*)/', $this->attributes, $matches);

        return Str::of($matches['tags'] ?? '')
            ->explode(',')
            ->filter()
            ->all();
    }

    public function getIpfsContentId(): ?string
    {
        preg_match('/metadata:(?<metadata>[\w]*)/', $this->attributes, $matches);

        return $matches['metadata'] ?? null;
    }

    protected static function transformResponse(array $res): array
    {
        return array_merge($res, [
            'attributes' => isset($res['attributes']) ? base64_decode($res['attributes']) : null,
        ]);
    }
}
