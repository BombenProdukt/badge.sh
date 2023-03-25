<?php

declare(strict_types=1);

namespace App\Badges\CodeClimate\Badges;

use App\Data\BadgePreviewData;
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
            new BadgePreviewData(
                name: 'coverage',
                path: '/codeclimate/coverage/codeclimate/codeclimate',
                data: $this->render([]),
            ),
        ];
    }
}
