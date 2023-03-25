<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class GitHubIssuesBadge extends AbstractBadge
{
    protected array $routes = [
        '/packagist/github-open-issues/{package}',
    ];

    protected array $keywords = [
        Category::ISSUE_TRACKING,
    ];

    public function handle(string $package, ?string $channel = null): array
    {
        return [
            'issues' => $this->client->get($package)['github_open_issues'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('github issues', $properties['issues']);
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
            '/packagist/github-open-issues/monolog/monolog' => 'github issues',
        ];
    }
}
