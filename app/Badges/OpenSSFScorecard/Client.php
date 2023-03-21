<?php

declare(strict_types=1);

namespace App\Badges\OpenSSFScorecard;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.securityscorecards.dev')->throw();
    }

    public function score(string $host, string $orgName, string $repoName): float
    {
        return $this->client->get("projects/{$host}/{$orgName}/{$repoName}")->json('score');
    }
}
