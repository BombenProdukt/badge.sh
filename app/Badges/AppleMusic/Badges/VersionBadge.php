<?php

declare(strict_types=1);

namespace App\Badges\AppleMusic\Badges;

use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/apple-music/version/{bundleId}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $bundleId): array
    {
        return [
            'version' => $this->client->version($bundleId),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            [
                'name' => 'version',
                'link' => '/apple-music/version/803453959',
                'code' => $this->render([
                    'version' => '1.0.0',
                ]),
            ],
        ];
    }
}
