<?php

declare(strict_types=1);

namespace App\Badges\AtomPackage\Badges;

use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/apm/version/{package}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    protected array $deprecated = [
        '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
    ];

    public function handle(string $package): array
    {
        return [
            'version' => $this->client->get($package)['releases']['latest'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            '/apm/version/linter' => 'version',
        ];
    }
}
