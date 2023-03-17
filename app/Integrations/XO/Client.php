<?php

declare(strict_types=1);

namespace App\Integrations\XO;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://cdn.jsdelivr.net/npm/')
            ->throw()
            ->withoutRedirecting();
    }

    public function get(string $name): array
    {
        return $this->client->get("{$name}/package.json")->json();
    }
}
