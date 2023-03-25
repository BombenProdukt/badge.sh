<?php

declare(strict_types=1);

namespace App\Badges\Sourceforge\Badges;

use App\Enums\Category;

final class DownloadsPerMonthBadge extends AbstractBadge
{
    protected array $routes = [
        '/sourceforge/downloads-monthly/{project}/{folder}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $project, string $folder): array
    {
        return [
            'downloads' => $this->client->stats($project, $folder, 30)['total'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloadsPerMonth($properties['downloads']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/sourceforge/downloads-monthly/arianne/stendhal' => 'monthly downloads',
        ];
    }
}
