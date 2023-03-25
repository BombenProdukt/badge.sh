<?php

declare(strict_types=1);

namespace App\Badges\CodeClimate\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class MaintainabilityBadge extends AbstractBadge
{
    protected array $routes = [
        '/codeclimate/maintainability/{project}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $project): array
    {
        return $this->client->get($project, 'snapshots')['attributes']['ratings'][0];
    }

    public function render(array $properties): array
    {
        return $this->renderGrade('maintainability', $properties['letter']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('project', RoutePattern::PACKAGE_WITH_VENDOR_ONLY->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/codeclimate/maintainability/codeclimate/codeclimate' => 'maintainability',
        ];
    }
}
