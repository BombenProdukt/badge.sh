<?php

declare(strict_types=1);

namespace App\Badges\Clojars;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://clojars.org/api')->throw();
    }

    public function get(string $clojar): array
    {
        return $this->client->get("artifacts/{$clojar}")->json();
    }
}
