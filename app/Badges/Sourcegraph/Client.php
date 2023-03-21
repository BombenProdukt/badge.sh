<?php

declare(strict_types=1);

namespace App\Badges\Sourcegraph;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://sourcegraph.com/.api')->throw();
    }

    public function dependents(string $repo): string
    {
        return trim($this->client->get("repos/{$repo}/-/shield")->json('value'));
    }
}
