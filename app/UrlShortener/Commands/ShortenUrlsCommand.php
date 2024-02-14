<?php

namespace App\UrlShortener\Commands;

use Illuminate\Support\Collection;

interface ShortenUrlsCommand
{
    public function getLongUrls(): Collection;
}
