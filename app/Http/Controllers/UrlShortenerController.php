<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use App\Http\Transformers\ShortCodeDetailsTransformer;
use App\Http\Transformers\ShortCodeTransformer;
use App\Models\UrlShortCodes;
use App\UrlShortener\Commands\ShortenUrlsHandler;
use App\UrlShortener\Repositories\UrlShortCodesRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use PHPUnit\Event\Dispatcher;

class UrlShortenerController extends Controller
{
    public function upload(FileUploadRequest $request, ShortenUrlsHandler $handler): JsonResponse
    {
        $command = $request->toCommand();
        $handler->handle($command);

        return new JsonResponse([
            'success' => true,
            'message' => 'Upload successful. Your CSV is processing.',
        ]);
    }

    public function details(int $shortCodeId, UrlShortCodesRepository $codes, ShortCodeDetailsTransformer $transformer): JsonResponse
    {
        $code = $codes->findById($shortCodeId);

        return new JsonResponse([
            'success' => true,
            'short_code' => $transformer->transform($code),
        ]);
    }

    public function listRecent(Request $request, UrlShortCodesRepository $codes, ShortCodeTransformer $transformer): JsonResponse
    {
        $limit = min($request->get('limit', 20), 100);

        $recentlyAdded = $codes->getRecent($limit);

        return new JsonResponse([
            'success' => true,
            'short_codes' => $recentlyAdded->map(
                fn(UrlShortCodes $model) => $transformer->transform($model)
            )->all(),
        ]);

    }
}
