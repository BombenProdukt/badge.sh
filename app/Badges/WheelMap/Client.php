<?php

declare(strict_types=1);

namespace App\Badges\WheelMap;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://wheelmap.org/api')->throw();
    }

    public function node(string $nodeId): array
    {
        return $this->client->get("nodes/{$nodeId}", [
            'api_key' => config('services.wheelmap.token'),
        ])->json('node.wheelchair');
    }
}
