<?php

declare(strict_types=1);

namespace App\Badges\Ecologi;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://public.ecologi.com')->throw();
    }

    public function carbon(string $username): float
    {
        return $this->client->get("users/{$username}/carbon-offset")->json('total');
    }

    public function trees(string $username): float
    {
        return $this->client->get("users/{$username}/trees")->json('total');
    }
}
