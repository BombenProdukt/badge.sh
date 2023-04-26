<?php

declare(strict_types=1);

namespace App\Badges\Chocolatey;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://community.chocolatey.org/api/v2')
            ->accept('application/atom+json,application/json')
            ->throw();
    }

    public function get(string $packageName, bool $includePrereleases = false): array
    {
        $releaseTypeFilter = $includePrereleases
            ? 'IsAbsoluteLatestVersion eq true'
            : 'IsLatestVersion eq true';

        return $this->client->get('Packages()', [
            '$filter' => "Id eq '{$packageName}' and {$releaseTypeFilter}",
        ])->json('d.results.0');
    }
}
