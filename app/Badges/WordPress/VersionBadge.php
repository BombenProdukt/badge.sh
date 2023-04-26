<?php

declare(strict_types=1);

namespace App\Badges\WordPress;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/wordpress/{extensionType:plugin,theme}/version/{extension}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $extensionType, string $extension): array
    {
        return $this->client->info($extensionType, $extension);
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version (plugin)',
                path: '/wordpress/plugin/version/bbpress',
                data: $this->render(['version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'version (theme)',
                path: '/wordpress/theme/version/twentyseventeen',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
