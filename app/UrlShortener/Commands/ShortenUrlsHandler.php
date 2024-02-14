<?php

namespace App\UrlShortener\Commands;

use App\Models\Urls;
use App\UrlShortener\Formatter;
use App\UrlShortener\Generator;
use App\UrlShortener\Repositories\UrlsRepository;
use App\UrlShortener\Repositories\UrlShortCodesRepository;
use Illuminate\Support\Collection;

readonly class ShortenUrlsHandler
{
    public function __construct(
        private UrlShortCodesRepository $shortCodes,
        private UrlsRepository          $urls,
        private Generator               $generator,
        private Formatter               $formatter,
    )
    {

    }

    public function handle(ShortenUrlsCommand $command): void
    {
        $longUrls = $command->getLongUrls()
            ->map(fn(string $url) => $this->formatter->format($url));

        $saved = $this->urls->upsertMany($longUrls);
        $mapped = $this->generateShortUrlsFor($saved);
        $this->shortCodes->insertMany($mapped);
    }

    private function generateShortUrlsFor(Collection $urls): Collection
    {
        return $urls->map(fn(Urls $url) => [
            'url_id' => $url->getId(),
            'short_code' => $this->generator->generate()
        ]);
    }
}
