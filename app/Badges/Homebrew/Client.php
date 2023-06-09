<?php

declare(strict_types=1);

namespace App\Badges\Homebrew;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://formulae.brew.sh/api/')->throw();
    }

    public function get(string $type, string $package): array
    {
        return $this->client->get("{$type}/{$package}.json")->json();
    }
}
