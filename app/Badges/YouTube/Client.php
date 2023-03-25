<?php

declare(strict_types=1);

namespace App\Badges\YouTube;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://www.googleapis.com/youtube/v3/')->throw();
    }

    public function channel(string $id): array
    {
        return $this->client->get('channels', [
            'id' => $id,
            'key' => config('services.youtube.token'),
            'part' => 'statistics',
        ])->json('items.0.statistics');
    }

    public function video(string $id): array
    {
        return $this->client->get('videos', [
            'id' => $id,
            'key' => config('services.youtube.token'),
            'part' => 'statistics',
        ])->json('items.0.statistics');
    }
}
