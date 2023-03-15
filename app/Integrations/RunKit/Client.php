<?php

declare(strict_types=1);

namespace App\Integrations\RunKit;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://runkit.io/')->throw();
    }

    public function get(string $owner, string $notebook, string $path): array
    {
        return $this->client->get("{$owner}/{$notebook}/branches/master/{$path}")->json();
    }
}
