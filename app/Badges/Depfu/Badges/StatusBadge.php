<?php

declare(strict_types=1);

namespace App\Badges\Depfu\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    protected array $routes = [
        '/depfu/status/{vcs}/{project}',
    ];

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

    public function previews(): array
    {
        return [
            '/depfu/status/github/depfu/example-ruby' => 'dependencies',
        ];
    }
}
