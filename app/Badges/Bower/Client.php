<?php

declare(strict_types=1);

namespace App\Badges\Bower;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://libraries.io/api/bower/')->throw();
    }

    public function get(string $packageName): array
    {
        return $this->client->get($packageName)->json();
    }
}
