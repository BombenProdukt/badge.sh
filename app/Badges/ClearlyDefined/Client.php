<?php

declare(strict_types=1);

namespace App\Badges\ClearlyDefined;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.clearlydefined.io/definitions/')->throw();
    }

    public function get(string $type, string $provider, string $namespace, string $name, string $revision): array
    {
        return $this->client->get("{$type}/{$provider}/{$namespace}/{$name}/{$revision}")->json();
    }
}
