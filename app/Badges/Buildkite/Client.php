<?php

declare(strict_types=1);

namespace App\Badges\Buildkite;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://badge.buildkite.com/')->throw();
    }

    public function status(string $identifier): string
    {
        return $this->client->get("{$identifier}.json")->json('status');
    }
}
