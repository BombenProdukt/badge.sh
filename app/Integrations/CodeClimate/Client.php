<?php

declare(strict_types=1);

namespace App\Integrations\CodeClimate;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.codeclimate.com/v1')->throw();
    }

    public function get(string $owner, string $repo, string $type, array $query = []): array
    {
        $meta   = $this->client->get('repos', ['github_slug' => "{$owner}/{$repo}"])->json('data.0');
        $report = $meta['relationships']['latest_default_branch_'.Str::singular($type)]['data'];

        return $this->client->get('repos/'.$meta['id']."/{$type}/".$report['id'])->json('data');
    }
}
