<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class NameBadge extends AbstractBadge
{
    protected array $routes = [
        '/packagist/name/{package:wildcard}',
    ];

    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $package, ?string $channel = null): array
    {
        return $this->client->get($package);
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'packagist',
            'message' => $properties['name'],
            'messageColor' => 'green.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'name',
                path: '/packagist/name/monolog/monolog',
                data: $this->render(['name' => 'monolog/monolog']),
            ),
        ];
    }
}
