<?php

declare(strict_types=1);

namespace App\Badges\RubyGems\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use PreemStudio\Formatter\FormatNumber;

final class LatestVersionDownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/rubygems/downloads-recently/{gem}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $gem): array
    {
        return [
            'downloads' => $this->client->get("gems/{$gem}")['version_downloads'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'downloads',
            'message' => FormatNumber::execute($properties['downloads']).' /version',
            'messageColor' => 'green.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'latest version downloads',
                path: '/rubygems/downloads-recently/rails',
                data: $this->render([]),
            ),
        ];
    }
}
