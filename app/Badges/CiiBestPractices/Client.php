<?php

declare(strict_types=1);

namespace App\Badges\CiiBestPractices;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://bestpractices.coreinfrastructure.org/')->throw();
    }

    public function get(string $projectId): array
    {
        return $this->client->get("projects/{$projectId}/badge.json")->json();
    }
}
