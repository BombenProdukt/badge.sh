<?php

declare(strict_types=1);

namespace App\Badges\CDNJS;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/cdnjs/version/{package:wildcard}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $package): array
    {
        return [
            'version' => $this->client->get($package),
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
                path: '/cdnjs/version/react',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
