<?php

declare(strict_types=1);

namespace App\Badges\Codeship;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://app.codeship.com/')->throw();
    }

    public function get(string $projectId, ?string $branch): string
    {
        return $this->client->get("projects/{$projectId}/status", ['branch' => $branch])->body();
    }
}
