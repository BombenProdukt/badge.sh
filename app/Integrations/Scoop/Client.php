<?php

declare(strict_types=1);

namespace App\Integrations\Scoop;

use Illuminate\Support\Facades\Http;

final class Client
{
    public function main(string $app): array
    {
        return Http::baseUrl('https://github.com/ScoopInstaller/Main/raw/master/bucket/')
            ->get("{$app}.json")
            ->throw()
            ->json();
    }

    public function extra(string $app): array
    {
        return Http::baseUrl('https://github.com/lukesampson/scoop-extras/raw/master/bucket/')
            ->get("{$app}.json")
            ->throw()
            ->json();
    }
}
