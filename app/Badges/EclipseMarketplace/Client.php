<?php

declare(strict_types=1);

namespace App\Badges\EclipseMarketplace;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://marketplace.eclipse.org')->throw();
    }

    public function get(string $name): Crawler
    {
        return new Crawler($this->client->get("content/{$name}/api/p")->body());
    }
}
