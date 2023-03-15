<?php

declare(strict_types=1);

namespace App\Integrations\DevRant;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://devrant.com/api')->throw();
    }

    public function get(string $userId): array
    {
        return $this->client->get("users/{$userId}", ['app' => 3])->json('profile');
    }

    public function getUserIdFromName(string $username): string
    {
        return (string) $this->client->get('get-user-id', ['username' => $username, 'app' => 3])->json('user_id');
    }
}
