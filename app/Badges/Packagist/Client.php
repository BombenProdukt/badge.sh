<?php

declare(strict_types=1);

namespace App\Badges\Packagist;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://packagist.org/packages/')->throw();
    }

    public function get(string $vendor, string $project): array
    {
        return $this->client->get("{$vendor}/{$project}.json")->json('package');
    }
}
