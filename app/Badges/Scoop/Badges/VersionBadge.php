<?php

declare(strict_types=1);

namespace App\Badges\Scoop\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/scoop/version/{app}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $app): array
    {
        return $this->client->main($app);
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
                path: '/scoop/version/1password-cli',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'version',
                path: '/scoop/version/adb',
                data: $this->render([]),
            ),
        ];
    }
}
