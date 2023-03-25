<?php

declare(strict_types=1);

namespace App\Badges\CodeClimate\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class MaintainabilityPercentageBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/codeclimate/maintainability-percentage/{project}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $project): array
    {
        $response = $this->client->get($project, 'snapshots');

        return [
            'percentage' => $response['attributes']['ratings'][0]['measure']['value'],
            'letter' => $response['attributes']['ratings'][0]['letter'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderGrade('maintainability', $properties['percentage'], $properties['letter']);
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
            '/codeclimate/maintainability-percentage/codeclimate/codeclimate' => 'maintainability (percentage)',
        ];
    }
}
