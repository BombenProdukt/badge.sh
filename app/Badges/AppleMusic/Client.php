<?php

declare(strict_types=1);

namespace App\Badges\AppleMusic;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://itunes.apple.com')->throw();
    }

    public function version(string $bundleId): string
    {
        return $this->client->get('lookup', ['id' => $bundleId])->json('results.0.version');
    }
}
