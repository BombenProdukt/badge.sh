<?php

declare(strict_types=1);

namespace App\Badges\DavidDM;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://david-dm.org/')->throw();
    }

    public function get(string $repo, string $path, string $prefix = ''): array
    {
        return $this->client->get("{$repo}/{$prefix}info.json", ['path' => $path])->json();
    }
}
