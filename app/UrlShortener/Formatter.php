<?php

namespace App\UrlShortener;

class Formatter
{
    public function format(string $url): FormattedUrl
    {
        $url = $this->removeTrailingAndLeadingSlashes($url);

        $parsed = parse_url(strtolower($url));

        return new FormattedUrl(
            $parsed['scheme'] ?? 'https',
           rtrim($parsed['host'], '/'),
            ltrim($parsed['path'], '/'),
            $parsed['query'] ?? '',
        );
    }

    private function removeTrailingAndLeadingSlashes(string $url): string
    {
        return ltrim(rtrim($url, '/'), '/');
    }
}
