<?php

declare(strict_types=1);

namespace App\Badges\TAS;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.tas.lambdatest.com')->throw();
    }

    public function get(string $provider, string $org, string $repo): array
    {
        return $this->client->get('repo/badge', [
            'git_provider' => $provider,
            'org'          => $org,
            'repo'         => $repo,
        ])->json('badge');
    }
}
