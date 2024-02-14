<?php

namespace App\Http\Transformers;

use App\Models\UrlShortCodes;

class ShortCodeTransformer
{
    public function transform(UrlShortCodes $code): array
    {
        return [
            'id' => $code->getId(),
            'short_code' => $code->getCode(),
            'short_code_url' => url('/p/' . $code->getCode()),
            'url' => $code->url->toString(),
            'created_at' => $code->getCreatedAt()->diffForHumans(),
            '_links' => [
                'self' => [
                    'href' => route('short_code_details', ['shortCodeId' => $code->getId()])
                ]
            ]
        ];
    }
}
