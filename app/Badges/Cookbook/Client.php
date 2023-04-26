<?php

declare(strict_types=1);

namespace App\Badges\Cookbook;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://supermarket.getchef.com/api/v1')->throw();
    }

    public function version(string $cookbook): string
    {
        return $this->client->get("cookbooks/{$cookbook}/versions/latest")->json('version');
    }
}
