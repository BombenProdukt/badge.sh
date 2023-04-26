<?php

declare(strict_types=1);

namespace App\Badges\WordPress;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class WordPressVersionBadge extends AbstractBadge
{
    protected string $route = '/wordpress/{extensionType:plugin,theme}/wordpress-version/{extension}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $extensionType, string $extension): array
    {
        return [
            'version' => $this->client->info($extensionType, $extension)['requires'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version'], 'WordPress');
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'required WordPress version (plugin)',
                path: '/wordpress/plugin/wordpress-version/bbpress',
                data: $this->render(['version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'required WordPress version (theme)',
                path: '/wordpress/theme/wordpress-version/twentyseventeen',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
