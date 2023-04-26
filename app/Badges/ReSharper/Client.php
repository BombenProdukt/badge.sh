<?php

declare(strict_types=1);

namespace App\Badges\ReSharper;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://resharper-plugins.jetbrains.com/api/v2')->throw();
    }

    public function get(string $packageName, bool $includePrereleases = false): Crawler
    {
        $releaseTypeFilter = $includePrereleases
            ? 'IsAbsoluteLatestVersion eq true'
            : 'IsLatestVersion eq true';

        return new Crawler($this->client->get('Packages()', [
            '$filter' => "Id eq '{$packageName}' and {$releaseTypeFilter}",
        ])->body());
    }
}
