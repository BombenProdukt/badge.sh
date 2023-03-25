<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Http;

final class DependabotStatusBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/github/dependabot/{owner}/{repo}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::ANALYSIS, Category::DEPENDENCIES,
    ];

    public function handle(string $owner, string $repo): array
    {
        return [
            'successful' => Http::get("https://api.github.com/repos/{$owner}/{$repo}/contents/.github/dependabot.yml")->successful(),
        ];
    }

    public function render(array $properties): array
    {
        if ($properties['successful']) {
            return [
                'label' => 'dependabot',
                'message' => 'Active',
                'messageColor' => 'green.600',
            ];
        }

        return [
            'label' => 'github',
            'message' => 'not found',
            'messageColor' => 'gray.600',
        ];
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
            '/github/dependabot/ubuntu/yaru' => 'dependabot status',
        ];
    }
}
