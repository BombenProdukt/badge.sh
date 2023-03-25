<?php

declare(strict_types=1);

namespace App\Badges\VaadinAddOnDirectory\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/vaadin/version/{packageName}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $packageName): array
    {
        return [
            'version' => $this->client->get($packageName)['latestAvailableRelease']['name'],
        ];
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
                path: '/vaadin/version/vaadinvaadin-grid',
                data: $this->render([]),
            ),
        ];
    }
}
