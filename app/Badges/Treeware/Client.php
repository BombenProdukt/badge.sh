<?php

declare(strict_types=1);

namespace App\Badges\Treeware;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://public.offset.earth')->throw();
    }

    public function get(string $owner, string $packageName): array
    {
        return $this->client->get('users/treeware/trees', ['ref' => md5("{$owner}/{$packageName}")])->json();
    }
}
