<?php

declare(strict_types=1);

namespace App\Badges\RubyGems;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://rubygems.org/api/v1/')->throw();
    }

    public function get(string $path): array
    {
        return $this->client->get("{$path}.json")->json();
    }
}
