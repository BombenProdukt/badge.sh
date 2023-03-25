<?php

declare(strict_types=1);

namespace App\Badges\PackageControl\Badges;

use App\Enums\Category;

final class DownloadsPerDayBadge extends AbstractBadge
{
    protected array $routes = [
        '/package-control/downloads-daily/{packageName}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $packageName): array
    {
        return [
            'downloads' => $this->client->get($packageName)['installs']['total'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloadsPerDay($properties['downloads']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/package-control/downloads-daily/GitGutter' => 'daily downloads',
        ];
    }
}
