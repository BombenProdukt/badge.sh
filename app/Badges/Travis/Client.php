<?php

declare(strict_types=1);

namespace App\Badges\Travis;

use Illuminate\Support\Facades\Http;

final class Client
{
    public function com(string $project, ?string $branch): string
    {
        return Http::baseUrl('https://api.travis-ci.com')
            ->get("{$project}.svg", ['branch' => $branch])
            ->throw()
            ->body();
    }

    public function org(string $project, ?string $branch): string
    {
        return Http::baseUrl('https://api.travis-ci.org')
            ->get("{$project}.svg", ['branch' => $branch])
            ->throw()
            ->body();
    }
}
