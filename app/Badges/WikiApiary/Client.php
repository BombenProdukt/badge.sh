<?php

declare(strict_types=1);

namespace App\Badges\WikiApiary;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://wikiapiary.com')->throw();
    }

    public function usage(string $variant, string $name)
    {
        return $this->client->get('w/api.php', [
            'action' => 'ask',
            'query'  => `[[{$variant}:{$name}]]|?Has_website_count`,
            'format' => 'json',
        ])->json('query.results');
    }
}
