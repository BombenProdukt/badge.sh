<?php

declare(strict_types=1);

namespace App\Badges\Depfu\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/depfu/status/{vcs}/{project}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::ANALYSIS, Category::DEPENDENCIES,
    ];

    public function handle(string $vcs, string $project): array
    {
        return [
            'status' => $this->client->get($vcs, $project),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStatus($this->service(), $properties['status']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('vcs', ['github', 'gitlab']);
        $route->where('project', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/depfu/status/github/depfu/example-ruby' => 'dependencies',
        ];
    }
}
