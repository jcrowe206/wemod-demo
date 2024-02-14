<?php

namespace App\UrlShortener\Repositories;

use App\Models\Urls;
use App\UrlShortener\FormattedUrl;
use Illuminate\Support\Collection;

readonly class UrlsRepository
{
    public function __construct(private Urls $model)
    {}

    public function upsertMany(Collection $longUrls): Collection
    {
        $inserts = $longUrls->map(fn(FormattedUrl $url) => [
            'fingerprint' => $url->getFingerprint(),
            'scheme' => $url->getScheme(),
            'path' => $url->getPath(),
            'host' => $url->getHost(),
            'query' => $url->getQueryString(),
        ]);
        $this->model->upsert($inserts->all(), ['fingerprint'], ['scheme', 'path', 'host', 'query']);
        return $this->model->whereIn('fingerprint', collect($inserts)->pluck('fingerprint')->all())->get();
    }
}
