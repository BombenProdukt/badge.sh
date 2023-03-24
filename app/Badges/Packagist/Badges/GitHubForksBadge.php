<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class GitHubForksBadge extends AbstractBadge
{
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

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/packagist/github-forks/{package}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::PACKAGE_WITH_VENDOR_ONLY->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/packagist/github-forks/monolog/monolog' => 'github followers',
        ];
    }
}
