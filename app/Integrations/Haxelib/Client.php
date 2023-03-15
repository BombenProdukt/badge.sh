<?php

declare(strict_types=1);

namespace App\Integrations\Haxelib;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('')->throw();
    }

    public function get(string $package): array
    {
        return $this->client->get($package)->json();
    }
}
