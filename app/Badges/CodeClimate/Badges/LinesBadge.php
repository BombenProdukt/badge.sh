<?php

declare(strict_types=1);

namespace App\Badges\CodeClimate\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class LinesBadge extends AbstractBadge
{
    public function handle(string $project): array
    {
        return [
            'lines' => $this->client->get($project, 'snapshots')['attributes']['lines_of_code'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderLines($properties['lines']);
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/codeclimate/lines/{project}',
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
            '/codeclimate/lines/codeclimate/codeclimate' => 'lines of code',
        ];
    }
}
