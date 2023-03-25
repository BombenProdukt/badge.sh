<?php

declare(strict_types=1);

namespace App\Badges\CodeClimate\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class CoverageBadge extends AbstractBadge
{
    protected array $routes = [
        '/codeclimate/coverage/{project}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $project): array
    {
        return [
            'percentage' => $this->client->get($project, 'test_reports')['attributes']['rating']['measure']['value'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderCoverage($properties['percentage']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('project', RoutePattern::PACKAGE_WITH_VENDOR_ONLY->value);
    }

    public function previews(): array
    {
        return [
            '/codeclimate/coverage/codeclimate/codeclimate' => 'coverage',
        ];
    }
}
