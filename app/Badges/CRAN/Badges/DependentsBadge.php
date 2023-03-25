<?php

declare(strict_types=1);

namespace App\Badges\CRAN\Badges;

use App\Enums\Category;

final class DependentsBadge extends AbstractBadge
{
    protected array $routes = [
        '/cran/dependents/{package}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $package): array
    {
        return [
            'count' => \count($this->client->db("/-/revdeps/{$package}")[$package]['Depends']),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('dependents', $properties['count']);
    }

    public function previews(): array
    {
        return [
            '/cran/dependents/R6' => 'dependents',
        ];
    }
}
