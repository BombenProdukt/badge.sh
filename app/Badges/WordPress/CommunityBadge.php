<?php

declare(strict_types=1);

namespace App\Badges\WordPress;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class CommunityBadge extends AbstractBadge
{
    protected string $route = '/wordpress/{extensionType:plugin,theme}/community/{extension}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $extensionType, string $extension): array
    {
        return $this->client->info($extensionType, $extension);
    }

    public function render(array $properties): array
    {
        return $this->renderText('community', $properties['is_community'] ? 'yes' : 'no');
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'community status (plugin)',
                path: '/wordpress/plugin/community/bbpress',
                data: $this->render(['is_community' => true]),
            ),
            new BadgePreviewData(
                name: 'community status (theme)',
                path: '/wordpress/theme/community/twentyseventeen',
                data: $this->render(['is_community' => false]),
            ),
        ];
    }
}
