<?php

namespace App\UrlShortener\Repositories;

use App\Models\UrlShortCodeAnalytics;
use App\Models\UrlShortCodes;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder;

readonly class ShortCodeAnalyticsRepository
{
    /**
     * @param UrlShortCodes|Builder|EloquentBuilder $model
     */
    public function __construct(private UrlShortCodeAnalytics $model)
    {}

    public function incrementShortCodeUsageCount(int $shortCodeId): void
    {
        $analytics = $this->model->firstOrCreate(['url_short_code_id' => $shortCodeId]);
        $analytics->increment('num_visits');
    }
}
