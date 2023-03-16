<?php

declare(strict_types=1);

namespace App\Integrations\Discord;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://discord.com/api/v8/')->throw();
    }

    public function get(string $inviteCode): array
    {
        return $this->client->get("invites/{$inviteCode}", ['with_counts' => true])->json();
    }
}
