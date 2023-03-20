<?php

declare(strict_types=1);

namespace App\Badges\UptimeRobot;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.uptimerobot.com/v2')->throw();
    }

    public function get(string $apiKey, int $numberOfDays = 30): array
    {
        return $this->client->post('getMonitors', [
            'api_key'              => $apiKey,
            'custom_uptime_ratios' => $numberOfDays,
            'response_times'       => 1,
            'response_times_limit' => 12,
        ])->json('monitors.0');
    }
}
