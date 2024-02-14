<?php

namespace App\UrlShortener\Repositories;

use App\Models\Urls;
use App\Models\UrlShortCodes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

readonly class UrlShortCodesRepository
{
    /**
     * @param UrlShortCodes|Builder|EloquentBuilder $model
     */
    public function __construct(private UrlShortCodes $model)
    {

    }

    public function insertMany(Collection $shortCodes): void
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');

        $inserts = $shortCodes->map(fn(array $data) => [
            'url_id' => $data['url_id'],
            'short_code' => $data['short_code'],
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $this->model->insert($inserts->all());
    }

    public function findByCode(string $requestedShortCode): UrlShortCodes
    {
        return $this->model->with('url')->where(['short_code' => $requestedShortCode])->firstOrFail();
    }

    public function getRecent(int $limit): Collection
    {
        return $this->model->with('url')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function findById(int $shortCodeId): UrlShortCodes
    {
        return $this->model->findOrFail($shortCodeId);
    }
}
