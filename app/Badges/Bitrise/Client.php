<?php

declare(strict_types=1);

namespace App\Badges\Bitrise;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://app.bitrise.io/')->throw();
    }

    public function get(string $token, string $appId, ?string $branch): array
    {
        return $this->client->get("app/{$appId}/status.json", [
            'branch' => $branch,
            'token' => $token,
        ])->json();
    }
}
