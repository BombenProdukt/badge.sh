<?php

declare(strict_types=1);

namespace App\Badges\MozillaObservatory;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://http-observatory.security.mozilla.org/api/v1')->throw();
    }

    public function get(string $host): array
    {
        return $this->client->post("analyze?host={$host}", ['hidden' => true])->json();
    }
}
