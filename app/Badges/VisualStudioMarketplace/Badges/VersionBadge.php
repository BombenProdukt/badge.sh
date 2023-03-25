<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioMarketplace\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/vs-marketplace/version/{extension}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $extension): array
    {
        return $this->client->get($extension)['versions'][0];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/vs-marketplace/version/vscodevim.vim',
                data: $this->render([]),
            ),
        ];
    }
}
