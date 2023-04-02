<?php

declare(strict_types=1);

namespace App\Badges\Codecov;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://codecov.io/api')->retry(10, 100)->throw();
    }

    public function get(string $service, string $user, string $repo, ?string $branch): array
    {
        return $this->client->get("{$service}/{$user}/{$repo}", ['branch' => $branch])->json();
    }
}
