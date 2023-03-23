<?php

declare(strict_types=1);

namespace App\Badges\Spiget;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.spiget.org/v2')->throw();
    }

    public function resource(string $resourceId): array
    {
        return $this->client->get("resources/{$resourceId}")->json();
    }

    public function latestVersion(string $resourceId): array
    {
        return $this->client->get("resources/{$resourceId}/versions/latest")->json();
    }
}
