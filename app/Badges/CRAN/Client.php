<?php

declare(strict_types=1);

namespace App\Badges\CRAN;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('')->throw();
    }

    public function db(string $package): array
    {
        return Http::baseUrl('https://crandb.r-pkg.org/')->get($package)->throw()->json();
    }

    public function logs(string $package): array
    {
        return Http::baseUrl('https://cranlogs.r-pkg.org/')->get($package)->throw()->json();
    }
}
