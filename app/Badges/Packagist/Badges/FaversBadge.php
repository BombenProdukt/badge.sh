<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class FaversBadge extends AbstractBadge
{
    protected array $routes = [
        '/packagist/favers/{package:packageWithVendorOnly}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $package, ?string $channel = null): array
    {
        return $this->client->get($package);
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('favers', $properties['favers']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'favers',
                path: '/packagist/favers/monolog/monolog',
                data: $this->render(['favers' => 1000000000]),
            ),
        ];
    }
}
