<?php

declare(strict_types=1);

namespace App\Badges\CodeClimate\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class CoverageGradeBadge extends AbstractBadge
{
    protected array $routes = [
        '/codeclimate/coverage-grade/{project}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

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

    public function routeConstraints(Route $route): void
    {
        $route->where('project', RoutePattern::PACKAGE_WITH_VENDOR_ONLY->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'coverage (letter)',
                path: '/codeclimate/coverage-grade/codeclimate/codeclimate',
                data: $this->render([]),
            ),
        ];
    }
}
