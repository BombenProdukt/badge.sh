<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class GitHubForksBadge extends AbstractBadge
{
    protected array $routes = [
        '/packagist/github-forks/{package}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $package, ?string $channel = null): array
    {
        return [
            'forks' => $this->client->get($package)['github_forks'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('github forks', $properties['forks']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::PACKAGE_WITH_VENDOR_ONLY->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'github followers',
                path: '/packagist/github-forks/monolog/monolog',
                data: $this->render(['forks' => 1000000000]),
            ),
        ];
    }
}
