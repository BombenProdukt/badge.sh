<?php

declare(strict_types=1);

namespace App\Badges\PackageControl\Badges;

use App\Enums\Category;

final class DownloadsPerMonthBadge extends AbstractBadge
{
    protected array $routes = [
        '/package-control/downloads-monthly/{packageName}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $packageName): array
    {
        $platforms = $this->client->get($packageName)['installs']['daily']['data'];

        $total = 0;

        foreach ($platforms as $platform) {
            for ($i = 0; $i < 30; $i++) {
                $total += $platform['totals'][$i];
            }
        }

        return [
            'downloads' => $total,
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloadsPerMonth($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            '/package-control/downloads-monthly/GitGutter' => 'monthly downloads',
        ];
    }
}
