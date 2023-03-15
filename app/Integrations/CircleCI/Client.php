<?php

declare(strict_types=1);

namespace App\Integrations\CircleCI;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

final class Client extends Controller
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://circleci.com/api/v1.1/')
            ->acceptJson()
            ->throw();
    }

    public function get(string $vcs, string $owner, string $repo, ?string $branch): array
    {
        $branch = $branch ? "/tree/{$branch}" : '';

        return $this->client->get("project/{$vcs}/{$owner}/{$repo}{$branch}", [
            'filter'  => 'completed',
            'limit'   => 1,
            'shallow' => true,
        ])->json();
    }
}
