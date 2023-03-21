<?php

declare(strict_types=1);

namespace App\Badges\PingPong;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.pingpong.one')->throw();
    }

    public function uptime(string $apiKey): float
    {
        return $this->client->get("widget/shields/uptime/{$apiKey}")->json('uptime');
    }
}
