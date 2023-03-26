<?php

declare(strict_types=1);

namespace App\Badges\LaravelForge;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://forge.laravel.com/site-badges')->throw();
    }

    public function get(string $site): array
    {
        return $this->client->get($site)->json();
    }
}
