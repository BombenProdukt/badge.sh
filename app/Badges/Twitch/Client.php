<?php

declare(strict_types=1);

namespace App\Badges\Twitch;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.twitch.tv/helix')->throw();

        if (! empty(config('services.twitch.client_id'))) {
            $this->client->withHeaders(['Client-ID' => config('services.twitch.client_id')]);
        }
    }

    public function user(string $username): array
    {
        $this->refreshToken();

        return $this->client->get('streams', ['user_login' => $username])->json('data');
    }

    public function extension(string $extension): array
    {
        $this->refreshToken();

        return $this->client->get('extensions/released', ['extension_id' => $extension])->json('data.0');
    }

    private function refreshToken(): void
    {
        if (empty(config('services.twitch.client_id'))) {
            return;
        }

        if (empty(config('services.twitch.client_secret'))) {
            return;
        }

        $this->client->withToken(
            Http::post('https://id.twitch.tv/oauth2/token?grant_type=client_credentials&client_id='.config('services.twitch.client_id').'&client_secret='.config('services.twitch.client_secret'))->json('access_token')
        );
    }
}
