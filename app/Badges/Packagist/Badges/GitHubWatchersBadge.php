<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class GitHubWatchersBadge extends AbstractBadge
{
    public function handle(string $package, ?string $channel = null): array
    {
        $packageMeta = $this->client->get($package);

        return [
            'label'        => 'watchers',
            'message'      => FormatNumber::execute($packageMeta['github_watchers']),
            'messageColor' => 'green.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/packagist/github-watchers/{package}',
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
            '/packagist-github/watchers/monolog/monolog' => 'github watchers',
        ];
    }
}
