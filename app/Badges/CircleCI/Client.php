<?php

declare(strict_types=1);

namespace App\Badges\CircleCI;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://circleci.com/api/v1.1/')
            ->acceptJson()
            ->throw();
    }

    public function get(string $vcs, string $user, string $repo, ?string $branch): array
    {
        $branch = $branch ? "/tree/{$branch}" : '';

        return $this->client->get("project/{$vcs}/{$user}/{$repo}{$branch}", [
            'filter' => 'completed',
            'limit' => 1,
            'shallow' => true,
        ])->json();
    }
}
