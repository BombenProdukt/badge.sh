<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class ReleaseBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/gitlab/latest-release/{repo}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $repo): array
    {
        $response = $this->client->rest($repo, 'releases')->json(0);

        if (empty($response)) {
            return [];
        }

        return [
            'version' => $response['name'],
        ];
    }

    public function render(array $properties): array
    {
        if (empty($properties['version'])) {
            return [
                'label' => 'release',
                'message' => 'none',
                'messageColor' => 'yellow.600',
            ];
        }

        return $this->renderVersion($properties['version'], 'release');
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('repo', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/gitlab/latest-release/veloren/veloren' => 'latest release',
        ];
    }
}
