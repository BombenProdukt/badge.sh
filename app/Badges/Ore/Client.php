<?php

declare(strict_types=1);

namespace App\Badges\Ore;

use Carbon\Carbon;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    private array $session = [];

    public function __construct()
    {
        $this->client = Http::baseUrl('https://ore.spongepowered.org/api/v2')
            ->acceptJson()
            ->asJson()
            ->throw();
    }

    public function get(string $pluginId): array
    {
        if (isset($this->session['expires'])) {
            if ($this->session['expires']->isPast()) {
                $this->refreshSessionToken();
            }
        } else {
            $this->refreshSessionToken();
        }

        return $this->client->withHeaders([
            'Authorization' => 'OreApi session='.$this->session['token'],
        ])->get("projects/{$pluginId}")->json();
    }

    private function refreshSessionToken(): void
    {
        $response = $this->client->post('authenticate', ['expires_in' => 600])->json();

        $this->session['token'] = $response['session'];
        $this->session['expires'] = Carbon::parse($response['expires']);
    }
}
