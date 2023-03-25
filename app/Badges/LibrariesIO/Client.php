<?php

declare(strict_types=1);

namespace App\Badges\LibrariesIO;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://libraries.io/api')->throw();
    }

    public function get(string $platform, string $package): array
    {
        return $this->client->get("{$platform}/".\urlencode($package))->json();
    }

    public function dependencies(string $platform, string $package, string $version): array
    {
        return $this->client->get("{$platform}/".\urlencode($package)."/{$version}/dependencies")->json();
    }

    public function github(string $package): array
    {
        return $this->client->get("github/{$package}/dependencies")->json();
    }
}
