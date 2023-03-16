<?php

declare(strict_types=1);

namespace App\Integrations\DavidDM;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://david-dm.org/')->throw();
    }

    public function get(string $owner, string $repo, string $path, string $prefix = ''): array
    {
        return $this->client->get("{$owner}/{$repo}/{$prefix}info.json", ['path' => $path])->json();
    }
}
