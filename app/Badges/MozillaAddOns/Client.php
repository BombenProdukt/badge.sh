<?php

declare(strict_types=1);

namespace App\Badges\MozillaAddOns;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://addons.mozilla.org/api/v3/')->throw();
    }

    public function get(string $name): array
    {
        return $this->client->get("addons/addon/{$name}")->json();
    }
}
