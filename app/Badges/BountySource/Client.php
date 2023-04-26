<?php

declare(strict_types=1);

namespace App\Badges\BountySource;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Yaml\Yaml;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.bountysource.com/')
            ->withHeaders(['Accept' => 'application/vnd.bountysource+json; version=2'])
            ->throw();
    }

    public function get(string $team): array
    {
        return Yaml::parse($this->client->get("teams/{$team}")->body());
    }
}
