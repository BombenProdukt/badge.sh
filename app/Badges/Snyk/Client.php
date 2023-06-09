<?php

declare(strict_types=1);

namespace App\Badges\Snyk;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://snyk.io')->throw();
    }

    public function get(string $package, ?string $targetFile): string
    {
        return $this->client->get("{$package}/badge.svg", ['targetFile' => $targetFile])->body();
    }
}
