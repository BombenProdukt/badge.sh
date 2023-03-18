<?php

declare(strict_types=1);

namespace App\Badges\Twitter;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://cdn.syndication.twimg.com/')->throw();
    }

    public function get(string $username): array
    {
        return $this->client->get('widgets/followbutton/info.json', ['screen_names' => $username])->json();
    }
}
