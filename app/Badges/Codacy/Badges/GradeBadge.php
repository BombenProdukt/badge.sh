<?php

declare(strict_types=1);

namespace App\Badges\Codacy\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class GradeBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/codacy/grade/{projectId}/{branch?}',
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
        \preg_match('/visibility=[^>]*?>([^<]+)<\//i', $this->client->get('grade', $projectId, $branch), $matches);

        return [
            'grade' => \trim($matches[1]),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderGrade('code quality', $properties['grade']);
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
            '/codacy/grade/f0875490cea1497a9eca9c25f3f7774e' => 'code quality',
            '/codacy/grade/f0875490cea1497a9eca9c25f3f7774e/master' => 'branch code quality',
        ];
    }
}
