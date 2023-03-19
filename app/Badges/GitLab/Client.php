<?php

declare(strict_types=1);

namespace App\Badges\GitLab;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

final class Client
{
    public function rest(string $repo, string $path): Response
    {
        return Http::baseUrl('https://gitlab.com/api/v4')
            ->withToken(config('services.gitlab.token'))
            ->throw()
            ->get('projects/'.urlencode($repo)."/{$path}");
    }

    public function graphql(string $repo, string $query): array
    {
        return Http::baseUrl('https://gitlab.com/api/graphql')
            ->withToken(config('services.gitlab.token'))
            ->throw()
            ->post('/', ['query' => "query { project(fullPath:\"{$repo}\") { {$query} } }"])
            ->json('data.project');
    }
}
