<?php

declare(strict_types=1);

namespace App\Badges\Jenkins\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Http;

final class PluginDownloadsBadge extends AbstractBadge
{
    public function handle(string $plugin, ?string $version = null): array
    {
        $response = Http::get("https://stats.jenkins.io/plugin-installation-trend/{$plugin}.stats.json")->throw()->json();

        if (empty($version)) {
            return [
                'downloads' => collect($response['installations'])->sum(),
            ];
        }

        return [
            'downloads' => collect($response['installationsPerVersion'][$version])->sum(),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('downloads', $properties['downloads']);
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
            '/jenkins/plugin-downloads/view-job-filters' => 'plugin downloads',
            '/jenkins/plugin-downloads/view-job-filters/1.26' => 'plugin downloads per version',
        ];
    }
}
