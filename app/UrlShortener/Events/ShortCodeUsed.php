<?php

namespace App\UrlShortener\Events;

readonly class ShortCodeUsed
{
    public function __construct(private int $shortCodeId)
    {}

    public function getShortCodeId(): int
    {
        return $this->shortCodeId;
    }
}
