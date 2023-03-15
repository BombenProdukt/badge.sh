<?php

declare(strict_types=1);

namespace App\Integrations\NuGet;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.nuget.org/v3-flatcontainer')->throw();
    }

    public function get(string $project): array
    {
        return $this->client->get(strtolower($project).'/index.json')->json();
    }
}
