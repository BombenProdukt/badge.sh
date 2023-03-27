<?php

declare(strict_types=1);

namespace App\Badges\Bundlephobia\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class MinBadge extends AbstractBadge
{
    protected string $route = '/bundlephobia/min/{name:wildcard}';

    protected array $keywords = [
        Category::SIZE,
    ];

    public function handle(string $name): array
    {
        return $this->client->get($name);
    }

    public function render(array $properties): array
    {
        return $this->renderSize($properties['size'], 'minified size');
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'minified',
                path: '/bundlephobia/min/react',
                data: $this->render(['size' => '1000']),
            ),
        ];
    }
}
