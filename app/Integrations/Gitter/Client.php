<?php

declare(strict_types=1);

namespace App\Integrations\Gitter;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://gitter.im/')->throw();
    }

    public function get(string $org, string $room): string
    {
        return $this->client->get("{$org}/{$room}")->body();
    }
}
