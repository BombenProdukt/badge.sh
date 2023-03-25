<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class GitHubStarsBadge extends AbstractBadge
{
    protected array $routes = [
        '/packagist/github-stars/{package}',
    ];

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $package, ?string $channel = null): array
    {
        return [
            'stars' => $this->client->get($package)['github_stars'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('github stars', $properties['stars']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::PACKAGE_WITH_VENDOR_ONLY->value);
    }

    public function previews(): array
    {
        return [
            '/packagist/github-stars/monolog/monolog' => 'github stars',
        ];
    }
}
