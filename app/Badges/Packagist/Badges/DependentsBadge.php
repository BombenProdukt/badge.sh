<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DependentsBadge extends AbstractBadge
{
    protected array $routes = [
        '/packagist/dependents/{package:wildcard}',
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
        return $this->renderNumber('dependents', $properties['dependents']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'dependents',
                path: '/packagist/dependents/monolog/monolog',
                data: $this->render(['dependents' => 1000000000]),
            ),
        ];
    }
}
