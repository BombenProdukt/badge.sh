<?php

declare(strict_types=1);

namespace App\Badges\ArchLinux;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://www.archlinux.org/')->throw();
    }

    public function get(string $repository, string $architecture, string $package): array
    {
        return $this->client->get("packages/{$repository}/{$architecture}/{$package}/json")->json();
    }
}
