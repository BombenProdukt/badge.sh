<?php

declare(strict_types=1);

namespace App\Integrations\AtomPackage;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://atom.io/api/')->throw();
    }

    public function get(string $package): array
    {
        return $this->client->get("packages/{$package}")->json();
    }
}
