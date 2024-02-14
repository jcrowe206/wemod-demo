<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UrlShortCodeAnalytics extends Model
{
    protected $table = 'url_short_code_analytics';

    protected $fillable = [
        'url_short_code_id',
        'num_visits',
    ];

    public $timestamps = false;

    public function url(): BelongsTo
    {
        return $this->belongsTo(UrlShortCodes::class, 'url_short_code_id', 'id');
    }

    public function getNumberOfVisits(): int
    {
        return $this->num_visits;
    }
}
