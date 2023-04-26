<?php

declare(strict_types=1);

namespace App\Badges\Crates;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use BombenProdukt\Formatter\FormatNumber;

final class LatestVersionDownloadsBadge extends AbstractBadge
{
    protected string $route = '/crates/downloads-recently/{package}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $package): array
    {
        return [
            'downloads' => $this->client->get($package)['recent_downloads'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'downloads',
            'message' => FormatNumber::execute((float) $properties['downloads']).' latest version',
            'messageColor' => 'green.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'downloads (latest version)',
                path: '/crates/downloads-recently/regex',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
