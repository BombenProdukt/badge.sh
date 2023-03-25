<?php

declare(strict_types=1);

namespace App\Badges\Keybase;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://keybase.io/_/api/1.0/')->throw();
    }

    public function get(string $username, string $fields): array
    {
        return $this->client->get('user/lookup.json', [
            'username' => $username,
            'fields' => $fields,
        ])->json();
    }
}
