<?php

declare(strict_types=1);

namespace App\Badges\BStats;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://bstats.org/api/v1')->throw();
    }

    public function servers(string $pluginId): array
    {
        return $this->client->get("plugins/{$pluginId}/charts/servers/data", ['maxElements' => 1])->json('0.1');
    }

    public function players(string $pluginId): array
    {
        return $this->client->get("plugins/{$pluginId}/charts/players/data", ['maxElements' => 1])->json('0.1');
    }
}
