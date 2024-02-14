<?php

namespace App\Http\Controllers;

use App\Models\UrlShortCodes;
use App\UrlShortener\Events\ShortCodeUsed;
use App\UrlShortener\Repositories\UrlShortCodesRepository;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProxyController extends Controller
{

    public function proxy(Request $request, UrlShortCodesRepository $shortCodes, Dispatcher $events): RedirectResponse
    {
        preg_match(
            '/^p\/(.*)/',
            $request->path(),
            $requestedShortCode
        );

        $requestedShortCode = $requestedShortCode[1] ?? null;

        if (!$requestedShortCode) {
            throw new NotFoundHttpException();
        }

        $entry = $shortCodes->findByCode($requestedShortCode);

        $events->dispatch(new ShortCodeUsed($entry->getId()));

        return new RedirectResponse($entry->url->toString());
    }
}
