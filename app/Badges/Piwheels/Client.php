<?php

declare(strict_types=1);

namespace App\Badges\Piwheels;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://www.piwheels.org')->throw();
    }

    public function get(string $wheel): array
    {
        return $this->client->get("project/{$wheel}/json/")->json();
    }
}
