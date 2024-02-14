<?php

namespace App\UrlShortener;

use Random\Randomizer;

class Generator
{
    private string $alphabet = 'bcdfhjklmpqstuvwxyzBCDFHJKLMPQRSTUVWXYZ1234567890';

    public function __construct(private readonly Randomizer $randomizer)
    {}

    public function generate(): string
    {
        return $this->randomizer->getBytesFromString(
            $this->alphabet,
            rand(6, 10)
        );
    }
}
