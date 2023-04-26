<?php

declare(strict_types=1);

namespace App\Badges\Spack;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://packages.spack.io')->throw();
    }

    public function version(string $packageName): string
    {
        return $this->client->get("data/packages/{$packageName}.json")->json('latest_version');
    }
}
