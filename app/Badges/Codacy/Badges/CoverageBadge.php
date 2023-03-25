<?php

declare(strict_types=1);

namespace App\Badges\Codacy\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class CoverageBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/codacy/coverage/{projectId}/{branch?}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $projectId, ?string $branch = null): array
    {
        \preg_match('/text-anchor=[^>]*?>([^<]+)<\//i', $this->client->get('coverage', $projectId, $branch), $matches);

        return [
            'percentage' => \trim($matches[1]),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderCoverage($properties['percentage']);
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/codacy/coverage/f0875490cea1497a9eca9c25f3f7774e' => 'coverage',
            '/codacy/coverage/f0875490cea1497a9eca9c25f3f7774e/master' => 'branch coverage',
        ];
    }
}
