<?php

declare(strict_types=1);

namespace App\Badges\CRAN\Badges;

use App\Enums\Category;

final class RVersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/cran/r-version/{package}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $package): array
    {
        return [
            'version' => \preg_replace('/([<>=]+)\s+/', '$1', $this->client->db($package)['Depends']['R']),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version'], 'R');
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/cran/r-version/data.table' => 'r version',
        ];
    }
}
