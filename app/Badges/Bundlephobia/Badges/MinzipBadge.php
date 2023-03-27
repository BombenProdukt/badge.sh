<?php

declare(strict_types=1);

namespace App\Badges\Bundlephobia\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class MinzipBadge extends AbstractBadge
{
    protected string $route = '/bundlephobia/minzip/{name:wildcard}';

    protected array $keywords = [
        Category::SIZE,
    ];

    public function handle(string $name): array
    {
        return [
            'size' => $this->client->get($name)['gzip'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderSize($properties['size'], 'minzipped size');
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'minified + gzip',
                path: '/bundlephobia/minzip/react',
                data: $this->render(['size' => '1000']),
            ),
            new BadgePreviewData(
                name: '(scoped pkg) minified + gzip',
                path: '/bundlephobia/minzip/@material-ui/core',
                data: $this->render(['size' => '1000']),
            ),
        ];
    }
}
