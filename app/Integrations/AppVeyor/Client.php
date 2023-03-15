<?php

declare(strict_types=1);

namespace App\Integrations\AppVeyor;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://ci.appveyor.com/api')->throw();
    }

    public function get(string $account, string $project, string $branch): array
    {
        return $this->client->get("projects/{$account}/{$project}{$branch}")->json();
    }
}
