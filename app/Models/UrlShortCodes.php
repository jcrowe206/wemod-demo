<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UrlShortCodes extends Model
{

    protected $table = 'url_short_codes';

    protected $fillable  = [
        'url_id',
        'short_code',
        'created_at',
        'updated_at',
    ];


    public function analytics(): HasOne
    {
        return $this->hasOne(UrlShortCodeAnalytics::class, 'url_short_code_id', 'id');
    }

    public function url(): BelongsTo
    {
        return $this->belongsTo(Urls::class, 'url_id', 'id');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->short_code;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->created_at;
    }
}
