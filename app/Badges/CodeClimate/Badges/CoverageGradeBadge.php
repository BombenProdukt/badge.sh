<?php

declare(strict_types=1);

namespace App\Badges\CodeClimate\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class CoverageGradeBadge extends AbstractBadge
{
    public function handle(string $project): array
    {
        return [
            'letter' => $this->client->get($project, 'test_reports')['attributes']['rating']['letter'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderGrade('coverage', $properties['letter']);
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/codeclimate/coverage-grade/{project}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
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
            '/codeclimate/coverage-grade/codeclimate/codeclimate' => 'coverage (letter)',
        ];
    }
}
