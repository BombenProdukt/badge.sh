<?php

declare(strict_types=1);

namespace App\Badges\Depfu;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://depfu.com')->throw();
    }

    public function get(string $vcs, string $project): string
    {
        return $this->client->get("{$vcs}/shields/{$project}")->json('text');
    }
}
