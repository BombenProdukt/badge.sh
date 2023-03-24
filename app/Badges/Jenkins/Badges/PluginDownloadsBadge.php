<?php

declare(strict_types=1);

namespace App\Badges\Jenkins\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Jenkins\Client;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Http;
use Illuminate\Routing\Route;

final class PluginDownloadsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $plugin, ?string $version = null): array
    {
        $response = Http::get("https://stats.jenkins.io/plugin-installation-trend/{$plugin}.stats.json")->throw()->json();

        if (empty($version)) {
            return $this->renderNumber('downloads', collect($response['installations'])->sum());
        }

        return $this->renderNumber('downloads', collect($response['installationsPerVersion'][$version])->sum());
    }

    public function service(): string
    {
        return 'Jenkins';
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/jenkins/plugin-downloads/{plugin}/{version?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('job', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/jenkins/plugin-downloads/view-job-filters'      => 'plugin downloads',
            '/jenkins/plugin-downloads/view-job-filters/1.26' => 'plugin downloads per version',
        ];
    }
}
