<?php

declare(strict_types=1);

namespace App\Badges\RubyGems\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class TotalDownloadsBadge extends AbstractBadge
{
    protected string $route = '/rubygems/downloads/{gem}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $gem): array
    {
        return $this->client->get("gems/{$gem}");
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'total downloads',
                path: '/rubygems/downloads/rails',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
