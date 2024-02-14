<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Urls extends Model
{
   protected $table = 'urls';

   public function shortCodes(): HasMany
   {
       return $this->hasMany(UrlShortCodes::class, 'url_id', 'id');
   }

    public function getId(): int
    {
        return $this->id;
    }

    public function toString(): string
    {
        return $this->scheme
            . '://'
            . $this->host
            . '/'
            . $this->path
            . ($this->query ? '?' . $this->query : '');
    }
}
