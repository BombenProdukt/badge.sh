<?php

declare(strict_types=1);

namespace App\Badges\OpenCollective;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://opencollective.com/')->throw();
    }

    public function get(string $package): array
    {
        return $this->client->get("{$package}.json")->json();
    }

    public function fetchCollectiveBackersCount(string $collective, ?string $userType = null, ?string $tierId = null): int
    {
        $userType ??= 'all';

        return \count($this->client->get("{$collective}/members/{$userType}.json", ['TierId' => $tierId])->json());
    }
}
