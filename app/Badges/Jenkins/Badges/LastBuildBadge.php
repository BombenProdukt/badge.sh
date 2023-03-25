<?php

declare(strict_types=1);

namespace App\Badges\Jenkins\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class LastBuildBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/jenkins/last-build/{hostname}/{job}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(string $hostname, string $job): array
    {
        return [
            'status' => $this->client->get($hostname, $job, 'lastBuild/api/json?tree=result,timestamp,estimatedDuration')['result'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'Last Build',
            'message' => $properties['status'],
            'messageColor' => \mb_strtolower($properties['status']) === 'success' ? 'green.600' : 'red.600',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('job', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/jenkins/last-build/jenkins.mono-project.com/job/test-mono-mainline' => 'Last build status',
        ];
    }
}
