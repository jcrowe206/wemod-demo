<?php

namespace App\UrlShortener;

readonly class FormattedUrl
{
    public function __construct(
        private string $scheme,
        private string $host,
        private string $path,
        private ?string $queryString = null
    ) {}

    public function getFingerprint(): string
    {
        return md5(
            $this->getScheme() .
            $this->getHost() .
            $this->getPath() .
            $this->getQueryString()
        );
    }

    public function getScheme(): string
    {
        return $this->scheme;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getQueryString(): ?string
    {
        return $this->queryString;
    }


}
