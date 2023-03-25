<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioMarketplace\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class InstallationsBadge extends AbstractBadge
{
    protected array $routes = [
        '/vs-marketplace/installations/{extension}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $extension): array
    {
        return [
            'count' => collect($this->client->get($extension)['statistics'])->firstWhere('statisticName', 'install')['value'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('installations', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'installation count',
                path: '/vs-marketplace/installations/vscodevim.vim',
                data: $this->render([]),
            ),
        ];
    }
}
