<?php

declare(strict_types=1);

namespace App\Badges\FreeCodeCamp;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.freecodecamp.org/api')->throw();
    }

    public function get(string $username): array
    {
        return $this->client->get('users/get-public-profile', ['username' => $username])->json();
    }
}
