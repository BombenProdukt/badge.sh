<?php

declare(strict_types=1);

namespace App\Integrations\Snapcraft;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.snapcraft.io/v2/snaps/')
            ->withHeaders(['Snap-Device-Series' => '16'])
            ->throw();
    }

    public function get(string $snap, array $fields = []): array
    {
        return $this->client->get("info/{$snap}", $fields ? ['fields' => $fields] : null)->json();
    }
}
