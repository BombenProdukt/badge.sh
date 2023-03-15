<?php

declare(strict_types=1);

namespace App\Integrations\Tidelift;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://tidelift.com/badges/package/')
            ->withoutRedirecting()
            ->throw();
    }

    public function get(string $platform, string $name): ?string
    {
        return $this->client->get("{$platform}/{$name}")->header('Location');
    }
}
