<?php

declare(strict_types=1);

namespace App\Badges\Jenkins\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Http;

final class PluginDownloadsBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/jenkins/plugin-downloads/{plugin}/{version?}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::DOWNLOADS,
    ];

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
