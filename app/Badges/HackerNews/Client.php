<?php

declare(strict_types=1);

namespace App\Badges\HackerNews;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://hacker-news.firebaseio.com/v0/user/')->throw();
    }

    public function karma(string $username): int
    {
        return $this->client->get("{$username}.json")->json('karma');
    }
}
