<?php

declare(strict_types=1);

namespace App\Badges\PowerShellGallery;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://www.powershellgallery.com/api/v2')
            ->accept('application/xml,text/xml')
            ->throw();
    }

    public function get(string $packageName, bool $includePrereleases = false): Crawler
    {
        $releaseTypeFilter = $includePrereleases
            ? 'IsAbsoluteLatestVersion eq true'
            : 'IsLatestVersion eq true';

        return new Crawler($this->client->get('Packages()', ['$filter' => "Id eq '{$packageName}' and {$releaseTypeFilter}"])->body());
    }
}
