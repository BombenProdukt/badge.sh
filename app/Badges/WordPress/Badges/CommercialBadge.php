<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class CommercialBadge extends AbstractBadge
{
    protected array $routes = [
        '/wordpress/{extensionType:plugin,theme}/commercial/{extension}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $extensionType, string $extension): array
    {
        return $this->client->info($extensionType, $extension);
    }

    public function render(array $properties): array
    {
        return $this->renderText('commercial', $properties['is_commercial'] ? 'yes' : 'no');
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'commercial status (plugin)',
                path: '/wordpress/plugin/commercial/bbpress',
                data: $this->render(['is_commercial' => true]),
            ),
            new BadgePreviewData(
                name: 'commercial status (theme)',
                path: '/wordpress/theme/commercial/twentyseventeen',
                data: $this->render(['is_commercial' => false]),
            ),
        ];
    }
}
