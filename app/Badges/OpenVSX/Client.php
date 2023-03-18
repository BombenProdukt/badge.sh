<?php

declare(strict_types=1);

namespace App\Badges\OpenVSX;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://open-vsx.org/api/')->throw();
    }

    public function get(string $namespace, string $package): array
    {
        return $this->client->get("{$namespace}/{$package}")->json();
    }
}
