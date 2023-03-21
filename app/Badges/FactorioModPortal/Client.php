<?php

declare(strict_types=1);

namespace App\Badges\FactorioModPortal;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://mods.factorio.com/api/mods/')->throw();
    }

    public function downloads(string $modName): int
    {
        return $this->client->get($modName)->json('downloads_count');
    }

    public function latestRelease(string $modName): array
    {
        return last($this->client->get($modName)->json('releases'));
    }
}
