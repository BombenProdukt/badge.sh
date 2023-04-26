<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioAppCenter;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.appcenter.ms/v0.1')->throw();
    }

    public function builds(string $owner, string $app, string $branch, string $token): string
    {
        $this->client->withHeaders(['X-API-Token' => $token]);

        return $this->client->get("apps/{$owner}/{$app}/branches/{$branch}/builds")->json('0.result');
    }

    public function releases(string $owner, string $app, string $token): array
    {
        $this->client->withHeaders(['X-API-Token' => $token]);

        return $this->client->get("apps/{$owner}/{$app}/releases/latest")->json('0.result');
    }
}
