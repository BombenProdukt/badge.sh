<?php

declare(strict_types=1);

namespace App\Badges\JetBrains;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://plugins.jetbrains.com')->throw();
    }

    public function info(string $pluginId): array
    {
        return $this->client->get('api/plugins/'.preg_replace('/[^0-9]/', '', $pluginId))->json();
    }

    public function updates(string $pluginId): array
    {
        return $this->client->get('api/plugins/'.preg_replace('/[^0-9]/', '', $pluginId).'/updates')->json();
    }

    public function rating(string $pluginId): array
    {
        return $this->client->get('api/plugins/'.preg_replace('/[^0-9]/', '', $pluginId).'/rating')->json();
    }

    public function legacy(string $pluginId): Crawler
    {
        return new Crawler($this->client->get('plugins/list', ['pluginId' => $pluginId])->body());
    }
}
