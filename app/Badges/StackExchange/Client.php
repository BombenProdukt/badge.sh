<?php

declare(strict_types=1);

namespace App\Badges\StackExchange;

use Carbon\Carbon;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.stackexchange.com/2.2')->throw();
    }

    public function questions(string $site, string $query): array
    {
        return $this->client->get('questions', [
            'filter'   => 'total',
            'fromdate' => Carbon::now()->submonth()->startOfMonth(),
            'key'      => config('services.stack_exchange.token'),
            'site'     => $site,
            'tagged'   => $query,
            'todate'   => Carbon::now()->submonth()->endOfMonth(),
        ])->json();
    }

    public function tags(string $site, string $query): array
    {
        return $this->client->get("tags/{$query}/info", [
            'key'  => config('services.stack_exchange.token'),
            'site' => $site,
        ])->json('items.0');
    }

    public function user(string $site, string $query): array
    {
        return $this->client->get("users/{$query}", [
            'key'  => config('services.stack_exchange.token'),
            'site' => $site,
        ])->json('items.0');
    }
}
