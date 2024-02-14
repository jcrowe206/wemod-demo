<?php

namespace App\UrlShortener\Events;

use App\UrlShortener\Repositories\ShortCodeAnalyticsRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

readonly class UpdateShortCodeAnalytics implements ShouldQueue
{
    public function __construct(private ShortCodeAnalyticsRepository $analytics)
    {}

    public function handle(ShortCodeUsed $event): void
    {
        $this->analytics->incrementShortCodeUsageCount($event->getShortCodeId());
    }

}
