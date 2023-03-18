<?php

declare(strict_types=1);

namespace App\Badges\Travis;

use Illuminate\Support\Facades\Http;

final class Client
{
    public function com(string $owner, string $repo, ?string $branch): string
    {
        return Http::baseUrl('https://api.travis-ci.com')
            ->get("{$owner}/{$repo}.svg", ['branch' => $branch])
            ->throw()
            ->body();
    }

    public function org(string $owner, string $repo, ?string $branch): string
    {
        return Http::baseUrl('https://api.travis-ci.org')
            ->get("{$owner}/{$repo}.svg", ['branch' => $branch])
            ->throw()
            ->body();
    }
}
