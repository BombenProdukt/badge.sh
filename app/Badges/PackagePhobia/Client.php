<?php

declare(strict_types=1);

namespace App\Badges\PackagePhobia;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://packagephobia.com/v2/')->throw();
    }

    public function get(string $package): array
    {
        return $this->client->get('api.json', ['p' => $package])->json();
    }
}
