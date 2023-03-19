<?php

declare(strict_types=1);

namespace App\Badges\Dependabot;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.dependabot.com/')->throw();
    }

    public function get(string $project, ?string $identifier): array
    {
        return $this->client->get('badges/status', [
            'host'       => 'github',
            'repo'       => $project,
            'identifier' => $identifier,
        ])->json();
    }
}
