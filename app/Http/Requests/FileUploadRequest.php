<?php

namespace App\Http\Requests;

use App\UrlShortener\Commands\ShortenUrlsFromCsv;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rules\File;
use League\Csv\Reader;

class FileUploadRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'file' => [
                'required',
                File::types(['csv', 'txt']),
            ]
        ];
    }

    public function toCommand(): ShortenUrlsFromCsv
    {
        /** @var UploadedFile $file */
        $file = $this->validated('file');
        return new ShortenUrlsFromCsv(
            Reader::createFromPath($file->getRealPath())
        );
    }
}
