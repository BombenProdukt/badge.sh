<?php

declare(strict_types=1);

namespace App\Badges\Repology;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://repology.org')->throw();
    }

    public function count(string $projectName): string
    {
        return $this->client->get("badge/tiny-repos/{$projectName}.svg")->body();
    }
}
