<?php

declare(strict_types=1);

namespace App\Integrations\Packagist;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://packagist.org/packages/')->throw();
    }

    public function get(string $vendor, string $package): array
    {
        return $this->client->get("{$vendor}/{$package}.json")->json('package');
    }
}
