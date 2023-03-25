<?php

declare(strict_types=1);

namespace App\Badges\Crates\Badges;

use App\Enums\Category;

final class LatestVersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/crates/version/{package}',
    ];

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

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/crates/version/regex' => 'version',
        ];
    }
}
