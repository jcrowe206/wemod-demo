<?php

namespace App\UrlShortener\Commands;

use Illuminate\Support\Collection;
use League\Csv\Reader;

class ShortenUrlsFromCsv implements ShortenUrlsCommand
{
    private array $records = [];

    public function __construct(private readonly Reader $csv)
    {
        $this->readCSVIntoRecords();
    }


    public function getLongUrls(): Collection
    {
        return collect($this->records);
    }

    private function readCSVIntoRecords(): void
    {
        foreach ($this->csv->getRecords() as $current) {
            $this->records[] = $current[0];
        }
    }
}
