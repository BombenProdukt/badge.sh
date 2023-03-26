<?php

declare(strict_types=1);

namespace App\Badges\Homebrew\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class MonthlyDownloadsForFormulaBadge extends AbstractBadge
{
    protected array $routes = [
        '/homebrew/downloads-monthly/{type:cask,formula}/{package}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $type, string $package): array
    {
        return [
            'downloads' => $this->client->get($type, $package)['analytics']['install']['30d'][$package],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloadsPerMonth($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'monthly downloads',
                path: '/homebrew/downloads-monthly/formula/fish',
                data: $this->render(['downloads' => '1000000']),
            ),
            new BadgePreviewData(
                name: 'monthly downloads',
                path: '/homebrew/downloads-monthly/cask/1password',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
