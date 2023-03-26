<?php

declare(strict_types=1);

namespace App\Badges\PackagePhobia\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class PublishBadge extends AbstractBadge
{
    protected array $routes = [
        '/packagephobia/publish/{name:wildcard}',
    ];

    protected array $keywords = [
        Category::SIZE,
    ];

    public function handle(string $name): array
    {
        $response = $this->client->get($name);

        return [
            'size' => $response['publish']['pretty'],
            'color' => $response['publish']['color'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'publish size',
            'message' => $properties['size'],
            'messageColor' => \str_replace('#', '', $properties['color']),
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'publish size',
                path: '/packagephobia/publish/webpack',
                data: $this->render(['size' => '1024', 'color' => '#4c1']),
            ),
            new BadgePreviewData(
                name: '(scoped pkg) publish size',
                path: '/packagephobia/publish/@tusbar/cache-control',
                data: $this->render(['size' => '1024', 'color' => '#4c1']),
            ),
        ];
    }
}
