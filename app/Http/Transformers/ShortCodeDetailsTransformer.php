<?php

namespace App\Http\Transformers;

use App\Models\UrlShortCodes;

class ShortCodeDetailsTransformer
{
    public function transform(UrlShortCodes $code): array
    {
        return [
            'id' => $code->getId(),
            'short_code' => $code->getCode(),
            'url' => $code->url->toString(),
            'num_visits' => $code->analytics?->getNumberOfVisits() ?: 0,
            'created_at' => $code->getCreatedAt()->diffForHumans(),
            '_links' => [
                'self' => [
                    'href' => route('short_code_details', ['shortCodeId' => $code->getId()])
                ]
            ]
        ];
    }
}
