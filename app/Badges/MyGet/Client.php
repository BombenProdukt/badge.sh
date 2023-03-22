<?php

declare(strict_types=1);

namespace App\Badges\MyGet;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://myget.org/')->throw();
    }

    public function get(string $feed, string $project): array
    {
        return $this->client->get($this->getSearchQueryService($feed), [
            'q'           => 'packageid:'.strtolower($project),
            'prerelease'  => true,
            'semVerLevel' => '2',
        ])->json('data.0');
    }

    private function getSearchQueryService(string $feed): string
    {
        return collect($this->client->get("F/{$feed}/api/v3/index.json")->json('resources'))->firstWhere('@type', 'SearchQueryService')['@id'];
    }
}
