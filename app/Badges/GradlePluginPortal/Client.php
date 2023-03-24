<?php

declare(strict_types=1);

namespace App\Badges\GradlePluginPortal;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://plugins.gradle.org')->throw();
    }

    public function get(string $pluginId): Crawler
    {
        $groupPath  = str_replace('.', '/', $pluginId);
        $artifactId = "{$pluginId}.gradle.plugin";

        return new Crawler($this->client->get("m2/{$groupPath}/{$artifactId}/maven-metadata.xml")->body());
    }
}
