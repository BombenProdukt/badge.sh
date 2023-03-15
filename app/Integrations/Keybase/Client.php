<?php

declare(strict_types=1);

namespace App\Integrations\Keybase;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://keybase.io/_/api/1.0/')->throw();
    }

    public function get(string $username): array
    {
        return $this->client->get('user/lookup.json', [
            'username' => $username,
            'fields'   => 'public_keys',
        ])->json();
    }
}
