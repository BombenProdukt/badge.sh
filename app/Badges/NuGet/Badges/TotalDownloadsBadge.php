<?php

declare(strict_types=1);

namespace App\Badges\NuGet\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Http;

final class TotalDownloadsBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/nuget/downloads/{project}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $project): array
    {
        return [
            'downloads' => Http::get('https://azuresearch-usnc.nuget.org/query', [
                'q' => 'packageid:'.\mb_strtolower($project),
                'prerelease' => 'true',
                'semVerLevel' => 2,
            ])->throw()->json('data.0.totalDownloads'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['downloads']);
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/nuget/downloads/Newtonsoft.Json' => 'total downloads',
        ];
    }
}
