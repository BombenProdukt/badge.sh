<?php

declare(strict_types=1);

namespace App\Badges\PackageControl\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class DownloadsPerWeekBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/package-control/downloads-weekly/{packageName}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $packageName): array
    {
        $platforms = $this->client->get($packageName)['installs']['daily']['data'];

        $total = 0;

        foreach ($platforms as $platform) {
            for ($i = 0; $i < 7; $i++) {
                $total += $platform['totals'][$i];
            }
        }

        return [
            'downloads' => $total,
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
            '/package-control/downloads-weekly/GitGutter' => 'weekly downloads',
        ];
    }
}
