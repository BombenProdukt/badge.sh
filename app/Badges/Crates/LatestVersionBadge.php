<?php

declare(strict_types=1);

namespace App\Badges\Crates;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LatestVersionBadge extends AbstractBadge
{
    protected string $route = '/crates/version/{package}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $package): array
    {
        return [
            'version' => $this->client->get($package)['max_version'],
        ];
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
                path: '/crates/version/regex',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
