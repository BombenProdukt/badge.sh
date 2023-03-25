<?php

declare(strict_types=1);

namespace App\Badges\SecurityHeaders\Badges;

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
        '/security-headers/grade/{url}/',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $url): array
    {
        return [
            'grade' => $this->client->grade($url),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderGrade('security headers', $properties['grade']);
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
            '/security-headers/grade/shields.io' => 'grade',
        ];
    }
}
