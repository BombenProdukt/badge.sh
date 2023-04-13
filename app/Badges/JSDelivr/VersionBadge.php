<?php

declare(strict_types=1);

namespace App\Badges\JSDelivr;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/jsdelivr/version/npm/{package:wildcard}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $package): array
    {
        return $this->client->cdn($package);
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
                path: '/jsdelivr/version/npm/lodash',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
