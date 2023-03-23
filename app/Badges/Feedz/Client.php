<?php

declare(strict_types=1);

namespace App\Badges\Feedz;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://f.feedz.io')->throw();
    }

    public function items(string $organization, string $repository, string $packageName): array
    {
        return collect($this->client->get($this->getSearchQueryService($organization, $repository)."{$packageName}/index.json")->json('items'))
            ->map(fn (array $item) => Http::get($item['@id'])->throw()->json())
            ->flatMap(fn (array $item) => $item['items'])
            ->map(fn (array $item) => $item['catalogEntry']['version'])
            ->toArray();
    }

    private function getSearchQueryService(string $organization, string $repository): string
    {
        return collect($this->client->get("{$organization}/{$repository}/nuget/index.json")->json('resources'))->firstWhere('@type', 'RegistrationsBaseUrl')['@id'];
    }
}
