<?php

declare(strict_types=1);

namespace App\Badges\WordPress;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class InstallationsBadge extends AbstractBadge
{
    protected string $route = '/wordpress/{extensionType:plugin,theme}/installations/{extension}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $extensionType, string $extension): array
    {
        return [
            'count' => $this->client->info($extensionType, $extension)['active_installs'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'active installations (plugin)',
                path: '/wordpress/plugin/installations/bbpress',
                data: $this->render(['count' => '1000000']),
            ),
            new BadgePreviewData(
                name: 'active installations (theme)',
                path: '/wordpress/theme/installations/twentyseventeen',
                data: $this->render(['count' => '1000000']),
            ),
        ];
    }
}
