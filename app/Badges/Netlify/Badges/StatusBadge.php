<?php

declare(strict_types=1);

namespace App\Badges\Netlify\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/netlify/status/{projectId}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(string $projectId): array
    {
        $status = $this->client->status($projectId);

        if (\str_contains($status, '#0F4A21')) {
            return [
                'status' => 'passing',
            ];
        }

        if (\str_contains($status, '#800A20')) {
            return [
                'status' => 'failing',
            ];
        }

        if (\str_contains($status, '#603408')) {
            return [
                'status' => 'building',
            ];
        }

        return [
            'status' => 'unknown',
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStatus('build', $properties['status']);
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
            '/netlify/status/e6d5a4e0-dee1-4261-833e-2f47f509c68f' => 'license',
        ];
    }
}
