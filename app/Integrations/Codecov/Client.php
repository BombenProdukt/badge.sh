<?php

declare(strict_types=1);

namespace App\Integrations\Codecov;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://codecov.io/api')->retry(5)->throw();
    }

    public function get(string $vcs, string $owner, string $repo, ?string $branch): array
    {
        return $this->client->get(implode('/', array_filter([$vcs, $owner, $repo, $branch])))->json();
    }
}
