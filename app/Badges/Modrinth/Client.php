<?php

declare(strict_types=1);

namespace App\Badges\Modrinth;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.modrinth.com/v2')->throw();
    }

    public function project(string $projectId): array
    {
        return $this->client->get("project/{$projectId}")->json('0');
    }

    public function version(string $projectId): array
    {
        return $this->client->get("project/{$projectId}/version")->json('0');
    }
}
