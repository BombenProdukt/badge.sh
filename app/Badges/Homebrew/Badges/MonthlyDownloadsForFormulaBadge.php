<?php

declare(strict_types=1);

namespace App\Badges\Homebrew\Badges;

use App\Enums\Category;

final class MonthlyDownloadsForFormulaBadge extends AbstractBadge
{
    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $package): array
    {
        return [
            'downloads' => $this->client->get('formula', $package)['analytics']['install']['30d'][$package],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloadsPerMonth($properties['downloads']);
    }

    public function routePaths(): array
    {
        return [
            '/homebrew/downloads-monthly/{package}',
            '/homebrew/downloads-monthly/formula/{package}',
            '/homebrew/downloads-monthly/cask/{package}',
        ];
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/homebrew/downloads-monthly/fish' => 'monthly downloads',
        ];
    }
}
