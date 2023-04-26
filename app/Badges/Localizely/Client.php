<?php

declare(strict_types=1);

namespace App\Badges\Localizely;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.localizely.com/v1')->throw();
    }

    public function get(string $apiToken, string $user, string $repo): array
    {
        return $this->client
            ->withHeaders(['X-Api-Token' => $apiToken])
            ->get("projects/{$user}/{$repo}/status")
            ->json();
    }
}
