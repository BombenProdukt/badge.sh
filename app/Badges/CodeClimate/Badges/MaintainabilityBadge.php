<?php

declare(strict_types=1);

namespace App\Badges\CodeClimate\Badges;

use App\Data\BadgePreviewData;
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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'maintainability',
                path: '/codeclimate/maintainability/codeclimate/codeclimate',
                data: $this->render([]),
            ),
        ];
    }
}
