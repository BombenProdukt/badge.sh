<?php

declare(strict_types=1);

namespace App\Badges\Cirrus;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.cirrus-ci.com')->throw();
    }

    public function github(string $owner, string $repo, ?string $branch, ?string $task, ?string $script): string
    {
        return $this->client->get("github/{$owner}/{$repo}.json", [
            'branch' => $branch,
            'script' => $script,
            'task' => $task,
        ])->json('status');
    }
}
