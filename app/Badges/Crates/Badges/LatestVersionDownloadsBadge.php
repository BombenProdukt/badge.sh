<?php

declare(strict_types=1);

namespace App\Badges\Crates\Badges;

use App\Enums\Category;
use PreemStudio\Formatter\FormatNumber;

final class LatestVersionDownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/crates/downloads-recently/{package}',
    ];

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
            'message' => FormatNumber::execute($properties['downloads']).' latest version',
            'messageColor' => 'green.600',
        ];
    }

    public function previews(): array
    {
        return [
            '/crates/downloads-recently/regex' => 'downloads (latest version)',
        ];
    }
}
