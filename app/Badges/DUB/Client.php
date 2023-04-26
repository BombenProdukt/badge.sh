<?php

declare(strict_types=1);

namespace App\Badges\DUB;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://code.dlang.org/api/packages/')->throw();
    }

    public function get(string $package)
    {
        return $this->client->get($package)->json();
    }
}
